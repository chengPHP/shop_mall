<?php

namespace App\Http\Controllers\Home;

use App\Models\CartItem;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GoodController extends Controller
{
    public function show($id){
        $info = Good::where('id',$id)->with('attr.color','brand','category','files')->first();
//        dump($info);
        return view('home.goods.show',compact('info'));
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

}
