<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $map = [
            ['status','>=',0]
        ];
        if($request->search){
            $search = $request->search;
            $map[] = [
                'name','like','%'.$search.'%'
            ];
        }else{
            $search = null;
        }
        $list = Member::with('get_member_head','rank')->where($map)->paginate(5);
        return view("admin.member.index",compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = new Member();
        $member->nickname = $request->nickname;
        $member->member_head = $request->member_head;
        $member->name = $request->name;
        $member->password = encrypt($request->password);
        $member->phone = $request->phone;
//        $member->email = $request->email;
        $member->password_question = $request->password_question;
        $member->password_answer = $request->password_answer;
        $member->sex = $request->sex;
        $member->birthday = $request->birthday;
//        $member->qq = $request->qq;
//        $member->office_phone = $request->office_phone;
//        $member->home_phone = $request->home_phone;
        $member->rank_id = 1;
        $member->rank_points = 0;
        $member->reg_time = date('Y-m-d H:i:s');
        $member->status = $request->status;

        if($request->file_id){
            $member->member_head = $request->file_id;
        }

        if($member->save()){
            $message = [
                'code' => 1,
                'message' => '会员用户添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '会员用户添加失败，请稍后重试'
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
        $map = [
            ['id','=',$id]
        ];
        $info = Member::where($map)->with('get_member_head','rank','address')->first();
        return view('admin.member.show',compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $map = [
            ['id','=',$id]
        ];
        $info = Member::where($map)->first();
        return view('admin.member.edit',compact('info'));
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
        $arr = $request->except('_method','_token','password','password_confirmation','file_id');
        if($request->password){
            $arr['password'] = encrypt($request->password);
        }

        if($request->file_id){
            $arr['member_head'] = $request->file_id;
        }

        $info = Member::where('id',$id)->update($arr);
        if($info){
            $message = [
                'code' => 1,
                'message' => '会员信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '会员信息修改失败，请稍后重试'
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
        //把ids字符串拆分成数组
        $idArr = explode(",",$id);
        foreach ($idArr as $v) {
            $info = Member::where("id", $v)->update(['status' => -1]);
            if ($info) {
                continue;
            } else {
                $message = [
                    'code' => 0,
                    'message' => '会员信息删除失败，请稍后重试'
                ];
                return response()->json($message);
            }
        }
        $message = [
            'code' => 1,
            'message' => '会员信息删除成功'
        ];
        return response()->json($message);
    }
}
