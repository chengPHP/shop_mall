<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logistic;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RefundOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_list = Order::with('member','address')->orderBy('id','desc')->paginate(5);
        return view('admin.order.index',compact('order_list'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_id = $id;
        $order_info = Order::where('id',$order_id)->with('member','address')->first();
        $order_item_list = OrderItem::where('order_id',$order_info->id)->with('good','attr','attr.color')->get();
        //物流详情
        $logistic_list = Logistic::where('order_id',$order_id)->orderBy('created_at','desc')->get();
        return view('admin.order.show',compact('order_info','order_item_list','logistic_list'));
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
        $order_info = Order::where('id',$id)->first();
        if($order_info['ship_status']==0 && !$order_info['closed']){
            $info = Order::where('id',$id)->update(['ship_status'=>1]);
            if($info){
                $message = [
                    'code' => 1,
                    'message' => '发货成功'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => '操作异常，请稍后重试'
                ];
            }
        }else{
            $message = [
                'code' => 0,
                'message' => '已确认发货，无需重复操作'
            ];
        }
        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order_info = Order::where('id',$id)->first();
        if(!$order_info['closed']){
            $info = Order::where('id',$id)->update(['closed'=>1]);
            if($info){
                $message = [
                    'code' => 1,
                    'message' => '订单关闭成功'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => '操作异常，请稍后重试'
                ];
            }
        }else{
            $message = [
                'code' => 0,
                'message' => '订单已关闭，无需重复操作'
            ];
        }
        return response()->json($message);
    }

    /**
     * 确认发货
     */
    public function seed_order(Request $request)
    {
        $order = Order::find($request->order_id);
        if($order->closed || $order->ship_status>0){
            $message = [
                'code' => 0,
                'message' => '已操作，无需重复操作'
            ];
        }else{
            $arr = [
                'ship_status' => 1
            ];
            $info = Order::where('id',$request->order_id)->update($arr);
            if($info){
                $message = [
                    'code' => 1,
                    'message' => '订单已发货'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => '操作异常，请稍后重试'
                ];
            }
        }
        return response()->json($message);
    }

    //拒绝退款
    public function to_refuse($id)
    {
        return view('admin.order.refuse',compact('id'));
    }

    public function refuse(Request $request)
    {
        $order_info = Order::find($request->order_id);
        if ($order_info->refuse_statu < 3) {
            $info = RefundOrder::where('order_id', $request->order_id)->update(['refuse_reason' => $request->refuse_reason]);
            if ($info) {
                Order::where('id',$request->order_id)->update(['refund_status'=>4]);
                $message = [
                    'code' => 1,
                    'message' => '拒绝退款成功'
                ];
            } else {
                $message = [
                    'code' => 0,
                    'message' => '操作失败'
                ];
            }

        } else {
            $message = [
                'code' => 0,
                'message' => '违规操作'
            ];
        }
        return response()->json($message);
    }


    public function handleRefund(Request $request)
    {
        $order = Order::find($request->order_id);
        $arr = [
            'refund_status' => 3,
            'closed' => 1
        ];
        $info = Order::where('id',$request->order_id)->update($arr);
        if($info){
            $message = [
                'code' => 1,
                'message' => '退款成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '退款失败，请稍后重试'
            ];
        }
        return response()->json($message);
//        $this->_refundOrder($order);
    }



    protected function _refundOrder(Order $order)
    {

//        $order->where()->update();

        /*// 判断该订单的支付方式
        switch ($order->payment_method) {
            case 'wechat':
                // 微信的先留空
                // todo
                break;
            case 'alipay':
                // 用我们刚刚写的方法来生成一个退款订单号
                $refundNo = Order::getAvailableRefundNo();
                $order = Order::where('id',$order->id)->first();
//                dd($order->total_amount);
                // 调用支付宝支付实例的 refund 方法
                $ret = app('alipay')->refund([
                    'out_trade_no' => $order->no, // 之前的订单流水号
                    'refund_amount' => $order->total_amount, // 退款金额，单位元
                    'out_request_no' => $refundNo, // 退款订单号
                ]);
//                dd($ret);
                // 根据支付宝的文档，如果返回值里有 sub_code 字段说明退款失败
                if ($ret->sub_code) {
                    // 将退款失败的保存存入 extra 字段
                    $extra = $order->extra;
                    $extra['refund_failed_code'] = $ret->sub_code;
                    // 将订单的退款状态标记为退款失败
                    Order::where('id',$order->id)->update([
//                        'refund_no' => $refundNo,
                        'refund_status' => 3,
                        'extra' => $extra,
                    ]);
                    return response()->json([
                        'code' => 1,
                        'message' => '退款成功'
                    ]);
                } else {
                    // 将订单的退款状态标记为退款成功并保存退款订单号
                    $order->update([
                        'refund_no' => $refundNo,
                        'refund_status' => Order::REFUND_STATUS_SUCCESS,
                    ]);
                }
                break;
            default:
                // 原则上不可能出现，这个只是为了代码健壮性
//                throw new InternalException('未知订单支付方式：'.$order->payment_method);
                break;
        }*/
    }


}
