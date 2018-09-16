<?php

namespace App\Http\Controllers\Home;

use App\Models\CartItem;
use App\Models\Good;
use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {
        //所有商品
        $good_list = Good::with('attr.color','brand','category','files')->get();
        return view('home.index.index',compact('good_list'));
    }

    /*public function good_info($id)
    {
        $info = Good::where('id',$id)->with('attr.color','brand','category','files')->first();
        return view("home.good.show",compact('info'));
    }

    public function add_good_to_car(Request $request)
    {
        //假设member_id=1
        if(!Session::get('member_id')){
            $message = [
                'code' => 2,
                'message' => '请先登录'
            ];
        }else{
            //再判断当前用户购物车里面是否已经存在此商品
            $map = [
                'member_id' => Session::get('member_id'),
                'good_id' => $request->good_id,
                'attr_id' => $request->attr_id
            ];
            $info = CartItem::where($map)->first();
            if($info){
                $result = CartItem::where('id',$info->id)->update(['amount'=>$info->amount+1]);
                if($result){
                    $message = [
                        'code' => 1,
                        'message' => '添加到购物车成功'
                    ];
                }else{
                    $message = [
                        'code' => 0,
                        'message' => '网络异常，请稍后重试'
                    ];
                }
            }else{
                $cart_item = new CartItem();
                $cart_item->member_id = Session::get('member_id');
                $cart_item->good_id = $request->good_id;
                $cart_item->attr_id = $request->attr_id;
                $cart_item->amount = 1;
                if($cart_item->save()){
                    $message = [
                        'code' => 1,
                        'message' => '添加到购物车成功'
                    ];
                }else{
                    $message = [
                        'code' => 0,
                        'message' => '网络异常，请稍后重试'
                    ];
                }
            }
        }
        return response()->json($message);
    }

    public function cart_detail()
    {
        if(!Session::get('member_id')){
            $message = [
                'code' => 0,
                'message' => '请先登录'
            ];
            return response()->json($message);
        }else{
            $member_id = Session::get('member_id');

            //购物车列表
            $good_list = CartItem::where('member_id',$member_id)->with('member','good.files','attr.color')->get();
            dump($good_list);
            //收货地址列表
            $member_info = Member::where('id',$member_id)->with('address')->first();
            dump($member_info);
            return view('home.car',compact('good_list','member_info'));
        }
    }

    public function add_order(Request $request)
    {
        dd($request->all());

        $order = new Order();

    }*/

}
