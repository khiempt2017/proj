<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeLoginValidate extends FormRequest
{
    private $table = 'user';
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
    public function rules() //Đặt quy tắc
    {
        
        $emailCondition  = "bail|required|email|"; 
        
        return [
            'email'              => $emailCondition,           
            'password'           => "bail|required|min:5"
        ];
    }

    public function messages() //Đổi nội dung cảnh báo
    {
        return [
            'email.required'        => 'email không được để trống',
            'password.required'     => 'password không được để trống',
        ];
    }

}
