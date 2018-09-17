<?php

namespace App\Http\Controllers\Home;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member_id = Session::get('member_id');
        //购物车列表
        $good_list = CartItem::where('member_id',$member_id)->with('member','good.files','attr.color')->get();
//
        //收货地址列表
        $address_list = Address::where('member_id',$member_id)->get();

        return view('home.cart.index',compact('good_list','address_list'));
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
        //
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
        $arr_id = explode(',',$id);
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
}
