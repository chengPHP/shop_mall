<?php

namespace App\Http\Controllers\Auth;

use App\Models\VerificationCode;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        /*return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);*/

        $result = false;
        $info = VerificationCode::where(['phone'=>$data['phone']])->orderBy("id","desc")->first();
        //当前时间戳
        $now_time = time();
        if($info){
            if(($info->create_time_stamp+config("program.ACTIVE_TIME"))>$now_time){
                $result = true;
            }
            //删除该验证码数据
            VerificationCode::where(['phone'=>$data['phone']])->delete();
        }

        $data = array_merge($data,['result'=>$result]);

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|digits_between:11,11|unique:users',
            'yzm' => 'required',
            'result' => 'accepted',
            'password' => 'required|string|min:6|confirmed',
        ],[
            'result.accepted' => '验证码输入有误'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
