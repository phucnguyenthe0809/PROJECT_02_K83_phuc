<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'email'=>'required|email|min:5',
            'password'=>'required|min:5'
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Email không được để trống',
            'email.email'=>'Email không đúng định dạng',
            'email.min'=>'Email không được ít hơn 5 ký tự',
            'password.required'=>'password không được để trống',
            'password.min'=>'password không được ít hơn 5 ký tự'
        ];
    }
}
