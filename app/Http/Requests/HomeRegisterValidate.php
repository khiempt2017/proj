<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRegisterValidate extends FormRequest
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
        
        $emailCondition  = "bail|required|min:5|unique:$this->table,email"; //Không được phép trùng tên với tên đã có trong DB khi bấm Save
        
        return [
            'email'              => $emailCondition, //Không cho phép trùng tên           
            
        ];
    }

    public function messages() //Đổi nội dung cảnh báo
    {
        return [
            'username.required'     => 'username không được để trống',
            'username.min'          => 'username là :input không hợp lệ. Độ dài phải hơn :min ký tự',
        ];
    }

}
