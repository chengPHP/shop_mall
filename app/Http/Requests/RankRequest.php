<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RankRequest extends FormRequest
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
                    'code' => 'required|max:255|unique:ranks',
                    'min_points' => 'required|min:0|numeric',
                    'max_points' => 'required|numeric',
                    'discount' => 'required|numeric|min:0|max:10',
                    'status' => 'required'
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|string|max:255',
                    'code' => 'required|max:255',
                    'min_points' => 'required|min:0|numeric',
                    'max_points' => 'required|numeric',
                    'discount' => 'required|numeric|min:0|max:10',
                    'status' => 'required'
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [
            'name.required'=>'请输入会员等级名称',
            'name.max'=>'用户名长度过长',

            'code.required'=>'请输入会员等级编号',
            'code.max'=>'会员等级编号过长',
            'code.unique'=>'该会员等级编号已存在',

            'min_points.required'=>'请输入最小积分值',
            'min_points.min'=>'积分最小值为零',
            'min_points.numeric'=>'积分必须为有效数值',

            'max_points.required'=>'请输入最大积分值',
            'max_points.numeric'=>'最大积分必须为有效数值',

            'discount.required'=>'请输入商品折扣值',
            'discount.numeric'=>'商品折扣值必须为有效数值',
            'discount.min'=>'商品折扣值最小值为零',
            'discount.max'=>'商品折扣值最大值为十',

            'status:required' => '状态值不能为空'
        ];
    }
}
