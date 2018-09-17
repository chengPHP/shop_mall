<?php

namespace App\Http\Controllers\Home;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function __construct()
    {
        if(!Session::get('member_id')){
            return redirect('/');
        }
    }

    //个人信息
    public function personal()
    {
        dd(Session::get('member_id'));
    }

    //我的购物车
    public function my_shop_cart()
    {

        $member_id = Session::get('member_id');
        //购物车列表
        $good_list = CartItem::where('member_id',$member_id)->with('member','good.files','attr.color')->get();
//
        //收货地址列表
        $member_info = Member::where('id',$member_id)->with('address')->first();

        return view('home.shop_cart',compact('good_list','member_info'));
    }

    //删除购物车指定商品
    public function delete_cart_shop(Request $request)
    {
        $arr_id = explode(',',$request->ids);
        if(CartItem::destroy($arr_id)){
            $message = [
                'code' => 1,
                'message' => '删除成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '商品删除失败，请稍后重试'
            ];
        }
        return response()->json($message);
    }

    //收货地址管理
    public function address()
    {
        $member_id = Session::get('member_id');
        //收货地址管理
        $map = [
            ['member_id',$member_id],
            ['status','>=',0]
        ];
        $list = Address::where($map)->get();
//        dd($list);
        return view('home.address',compact('list'));
    }

    //删除收货地址
    public function delete_address(Request $request)
    {
        if(Address::where('id',$request->id)->update(['status'=> -1])){
            $message = [
                'code' => 1,
                'message' => '删除成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '删除失败，请稍后重试'
            ];
        }
        return response()->json($message);
    }

    //
}
