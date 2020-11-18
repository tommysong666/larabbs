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
        return [
            'name'=>'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/',
            'introduction'=>'max:80'
        ];
    }

    public function messages()
    {
        return [
          'name.required'=>'用户名不能为空',
          'name.between'=>'用户名介于3到25个字符中间',
          'name.regex'=>'用户名只支持英文、数字、横杠和下划线',
          'introduction.max'=>'个人简介不能超过80个字符长度',
        ];
    }
}
