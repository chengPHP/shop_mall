<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                    'name' => 'required|max:255|unique:categories',
                    'alias' => 'nullable|max:255|unique:categories',
                    'status' => 'required'
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|max:255',
                    'alias' => 'nullable|max:255',
                    'status' => 'required'
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [
            'name.required'=>'请输入类别名称',
            'name.max'=>'类别名称长度过长',
            'alias.max'=>'类别别名过长',
        ];
    }
}
