<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'code'=>'required|min:3',
            'name'=>'required|min:3',
            'price'=>'required|numeric',
            'img'=>'image', // file phải là định dạng ảnh
        ];
    }
    public function messages()
    {
        return [
            'code.required'=>'Mã sản phẩm không được để trống!',
            'code.min'=>'Mã sản phẩm phải lớn hơn 3 ký tự!',
            'name.required'=>'Tên sản phẩm không được để trống!',
            'name.min'=>'Tên sản phẩm phải lớn hơn 3 ký tự!!',
            'price.required'=>'Giá sản phẩm không được để trống!',
            'price.numeric'=>'Giá sản phẩm không đúng định dạng!',
            'img.image'=>'File Ảnh không đúng định dạng!',
        ];
    }
}
