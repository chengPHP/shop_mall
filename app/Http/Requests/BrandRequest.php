<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
                    'name'=>'required',
                    'site_url'=>'required',
                    'status'=>'required',
                ];
                break;
            case 'PUT':
                return [
                    'name'=>'required',
                    'site_url'=>'required',
                    'status'=>'required',
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [
            'name.required'=>'请输入品牌名称',
            'site_url.required'=>'请输入品牌网址',
            'status.required'=>'请选择品牌所属状态',
        ];
    }
}
