<?php

namespace App\Http\Controllers\Home;

use App\Models\Attr;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
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
        $order_list = Order::where('member_id',$member_id)->with('member','address')->get();
        foreach ($order_list as $k=>$v){
//            dump($v['id']);
//            $order_list[$k]['item_list'] = OrderItem::where('order_id',$v['id'])->with('good','attr')->get();
        }
//        dd($order_list);
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
            'reviewed' => 0,
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
        return view('home.order.show',compact('order_info','order_item_list'));
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
     * 新增订单，跳转到待支付页面
     */
    public function to_pay($order_id)
    {
        $this->init();
//        http://shop_mall.me/member/order/to_pay/5
        dd($order_id);
        //订单详情
        $order_info = Order::where('id',$order_id)->with('member','address')->first();
        //
        $order_attr_list = OrderItem::where('order_id',$order_id)->with('good','attr')->get();

        return view('home.order.new_order',compact('order_info','order_attr_list'));

    }
}
