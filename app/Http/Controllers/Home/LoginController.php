<?php

namespace App\Http\Controllers\Home;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function to_login()
    {
        return view('home.login.login');
    }

    public function do_login(Request $request)
    {
        $map = [
            'phone' => $request->phone,
            'password' => $request->password
        ];
        $info = Member::where($map)->first();
        if($info){
            Session::put('member_id',$info->id);
            $message = [
                'code' => 1,
                'message' => '登陆成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '用户名或密码错误'
            ];
        }
        return response()->json($message);
    }
}
