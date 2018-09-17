<?php

namespace App\Http\Controllers\Home;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{

    public function __construct()
    {
        if(!Session::get('member_id')){
            return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member_id = Session::get('member_id');
        //收货地址管理
        $map = [
            ['member_id',$member_id],
            ['status','>=',0]
        ];
        $list = Address::where($map)->get();
        return view('home.address.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.address.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = new Address();
        $address->member_id = Session::get('member_id');
        $address->consignee = $request->consignee;
        $address->province = $request->province;
        $address->city = $request->city;
        $address->district = $request->district;
        $address->phone = $request->phone;
        $address->address = $request->address;
        $address->status = 1;

        if($address->save()){
            $message = [
                'code' => 1,
                'message' => '收件地址添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '收件地址添加失败，请稍后重试'
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
        $info = Address::find($id);
        return view('home.address.edit',compact('info'));
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

        $arr = [
            'consignee' => $request->consignee,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'phone' => $request->phone,
            'address' => $request->address
        ];

        if(Address::where('id',$id)->update($arr)){
            $message = [
                'code' => 1,
                'message' =>'收件地址信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '收件地址信息修改失败，请稍后重试'
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
        if(Address::where('id',$id)->update(['status'=> -1])){
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
}
