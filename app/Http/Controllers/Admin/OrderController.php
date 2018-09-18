<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logistic;
use App\Models\Order;
use App\Models\OrderItem;
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
}
