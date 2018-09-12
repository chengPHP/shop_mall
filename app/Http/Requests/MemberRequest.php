<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
                ];
                break;
            case 'PUT':
                return [
                ];
            case 'PATCH':
            default:break;
        }

    }

    public function messages()
    {
        return [

        ];
    }
}
