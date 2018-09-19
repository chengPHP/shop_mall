<?php

namespace App\Http\Controllers\Home;

use App\Models\Attr;
use App\Models\CartItem;
use App\Models\Evaluate;
use App\Models\Logistic;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RefundOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function init()
    {
        if(!Session::get('member_id')){
            redirect('/')->send();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->init();
        $member_id = Session::get('member_id');
        $order_list = Order::where('member_id',$member_id)->with('member','address')->orderBy('id','desc')->get();
        return view('home.order.index',compact('order_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->init();
        $attr_id = explode(',',$request->attr_id);
//        dd($attr_id);
        //商品总金额
        $total_amount = 0;
        $good_id = [];
        foreach ($attr_id as $id){
            $attr_info = Attr::where('id',$id)->with('good')->first();
            $cart_item = CartItem::where('attr_id',$id)->first();
            $total_amount += $attr_info['price'] * $cart_item->amount;
            $good_id[] = $attr_info->good[0]['id'];
        }

        $order = new Order();
        $arr = [
            'no' => $order->findAvailableNo(),
            'member_id' => Session::get('member_id'),
            'address_id' => $request->address_id,
            'total_amount' => $total_amount,
            'remark' => $request->remark,
//            'reviewed' => 0,
//            'paid_at' => date("y-m-d H:i:s"),
//            'payment_method' => "支付宝支付",
//            'payment_no' => date('YmdHis').rand(100,999),
            'closed' => 0,
//            'ship_status' => '未发货',
//            'ship_data' => '未发货',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $order_id = Order::insertGetId($arr);

        foreach ($attr_id as $k=>$v){
            $attr_infos = Attr::where('id',$v)->first();
            $cart_item = CartItem::where('attr_id',$v)->first();
            $item_arr = [
                'order_id' => $order_id,
                'good_id' => $good_id[$k],
                'attr_id' => $v,
                'amount' => $cart_item->amount,
                'price' => $attr_infos->price,
                'created_at' => date('Y-m-d H:i:s')
            ];
            OrderItem::insertGetId($item_arr);
            //sku减库存
            $info = Attr::where('id',$v)->update(['stock'=>$attr_infos->stock-$cart_item->amount]);
        }
        if($info){
            $message = [
                'code' => 1,
                'order_id' => $order_id,
                'message' => '订单生成成功，请尽快支付'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '错误，请稍后重试'
            ];
        }
        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->init();
        $order_id = $id;
        $order_info = Order::where('id',$order_id)->with('member','address')->first();
        $order_item_list = OrderItem::where('order_id',$order_info->id)->with('good','attr','attr.color')->get();
        //物流详情
        $logistic_list = Logistic::where('order_id',$order_id)->orderBy('created_at','desc')->get();
        return view('home.order.show',compact('order_info','order_item_list','logistic_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $order_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 新增订单，跳转到待支付页面
     */
    public function to_pay($order_id)
    {
        $this->init();
//        http://shop_mall.me/member/order/to_pay/5
        //订单详情
        $order_info = Order::where('id',$order_id)->with('member','address')->first();

        $order_attr_list = OrderItem::where('order_id',$order_id)->with('good','attr')->get();

        return view('home.order.new_order',compact('order_info','order_attr_list'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * 确认签收
     */
    public function delivers(Request $request)
    {
        $this->init();
        //订单是否属于当前用户
        $order_info = Order::find($request->order_id);
        if($order_info->member_id == Session::get('member_id')){
            $arr = [
                'ship_status' => 2
            ];
            $info = Order::where('id',$request->order_id)->update($arr);
            if($info){
                $message = [
                    'code' => 1,
                    'message' => '操作成功'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => '网络异常，请稍后重试'
                ];
            }
        }else{
            $message = [
                'code' => 0,
                'message' => '当前操作属于非法操作'
            ];
        }
        return response()->json($message);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 打开评价页面
     */
    public function to_evaluate($id)
    {
        $this->init();
        //订单详情
//        $order_info = Order::where('id',$id)->with('member','address')->first();
//        $order_attr_list = OrderItem::where('order_id',$id)->with('good','attr')->get();
//        return view('home.order.evaluate',compact('order_info','order_attr_list'));
        return view('home.order.evaluate',compact('id'));
    }

    public function do_evaluate(Request $request)
    {
        $this->init();
        if(Evaluate::where('order_id',$request->order_id)->first()){
            $message = [
                'code' => 0,
                'message' => '已作出评价，无需重复评价'
            ];
        }else{
            $evaluate = new Evaluate();
            $arr = [
                'order_id' => $request->order_id,
                'score' => $request->score,
                'contents' => $request->contents
            ];
            $evaluate_id = Evaluate::insertGetId($arr);
            if($evaluate_id){
                $map = [
                    'reviewed'=>1,
                    'evaluate_id' => $evaluate_id
                ];
                Order::where('id',$request->order_id)->update($map);
                $message = [
                    'code' => 1,
                    'message' => '感谢您的评价！'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => '网络异常，请稍后重试'
                ];
            }
        }
        return response()->json($message);
    }

    /**
     * 申请退款页面
     */

    public function to_refund($id)
    {
        return view('home.order.to_refund',compact('id'));
    }

    /**
     * @param Request $request
     * 上传申请退款理由
     */
    public function do_refund(Request $request)
    {
        $order_info = Order::find($request->order_id);
        if($order_info->refund_status){
            $message = [
                'code' => 0,
                'message' => '已发起申请退款或已处理'
            ];
        }else{
            $arr = [
                'order_id'=>$request->order_id,
                'refund_reason'=>$request->refund_reason
            ];
            $refund_order_id = RefundOrder::insertGetId($arr);
            $map = [
                'refund_status'=>1,
                'refund_no' => $refund_order_id
            ];
            $info = Order::where('id',$request->order_id)->update($map);
            if($info){
                $message = [
                    'code' => 1,
                    '退款申请成功，等待卖家处理'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => '处理异常，请稍后重试'
                ];
            }
        }
        return response()->json($message);
    }

}
