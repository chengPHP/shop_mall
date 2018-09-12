<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $map = [
            ['status',">=",0]
        ];
        if($request->search){
            $search = $request->search;
            $map[] = ['name','like',"%".$search."%"];
        }else{
            $search = '';
        }
        $list = User::where($map)->paginate(5);
        return view('admin.user.index',compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->phone;
        $user->password = encrypt($request->password);
        $user->status = $request->status;

        if($user->save()){
            $message = [
                'code' => 1,
                'message' => '用户添加成功'
            ];
        }else{
            $message =[
                'code' => 0,
                'message' => '用户添加失败，请稍后重试'
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
        $info = User::find($id);
        return view('admin.user.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $validator = Validator::make($request->all(), [
                'name' => Rule::unique('users')->ignore($id),
                'email' => Rule::unique('users')->ignore($id),
                'phone' => Rule::unique('users')->ignore($id),
            ],[
                'name.unique'=>'该用户名已存在',
                'email.unique'=>'该邮箱已存在',
                'phone.unique'=>'该手机号已存在',
            ]
        );

        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->getMessageBag()->getMessages() as $v){
                foreach ($v as $value){
                    $errors .= $value.',';
                }
            }
            $errors = trim($errors,",");
            $message = [
                'code' => 0,
                'message' => $errors
            ];
            return response()->json($message);
        }

        $arr = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status
        ];
        if($request->password){
            $arr['password'] = encrypt($request->password);
        }
        if(User::where('id',$id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '后台用户信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '后台用户信息修改失败，请稍后重试'
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
            if(!User::where('id',$v)->value('is_admin')){
                $info = User::where("id", $v)->update(['status' => -1]);
                if ($info) {
                    continue;
                } else {
                    $message = [
                        'code' => 0,
                        'message' => '用户信息删除失败，请稍后重试'
                    ];
                    return response()->json($message);
                }
            }else{
                $message = [
                    'code' => 0,
                    'message' => '超级管理员不能删除'
                ];
                return response()->json($message);
            }
        }
        $message = [
            'code' => 1,
            'message' => '后台用户信息删除成功'
        ];
        return response()->json($message);
    }
}
