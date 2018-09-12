<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()){
            case 'GET':
                break;
            case 'DELETE':
            {
                return [];
            }
                break;
            case 'POST':
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'phone' => 'required|min:11|max:11|unique:users',
                    'password' => 'required|string|min:6|max:18|confirmed',
                    'status' => 'required'
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'phone' => 'required|min:11|max:11',
                    'password' => 'nullable|min:6|max:18|confirmed',
                    'status' => 'required'
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [
            'name.required'=>'请输入用户名',
            'name.max'=>'用户名长度过长',
            'name.unique'=>'用户名已存在',

            'email.required'=>'请输入邮箱地址',
            'email.email'=>'请输入正确邮箱',
            'email.max'=>'用户名长度过长',
            'email.unique'=>'该邮箱已存在',

            'phone.required'=>'请输入手机号',
            'phone.min'=>'请正确输入手机号',
            'phone.max'=>'请正确输入手机号',
            'phone.unique'=>'该手机号已存在',

            'password.required'=>'请输入密码',
            'password.min'=>'密码至少六位',
            'password.max'=>'密码至多十八位',
            'password.confirmed'=>'两次密码输入不一致'
        ];
    }
}
