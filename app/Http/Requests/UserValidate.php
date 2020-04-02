<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidate extends FormRequest
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
        $id = $this->id;
        $thumbCondition     = 'bail|required|image';
        $usernameCondition  = "bail|required|min:5|unique:$this->table,name"; //Không được phép trùng tên với tên đã có trong DB khi bấm Save
        
        if(!empty($id)) //Nếu có tồn tại id được gửi lên server (tức là Edit) thì set điều kiện validate khác
        {
            $thumbCondition = 'bail|image';
            $usernameCondition  = "bail|required|min:5|unique:$this->table,name,$id";//Cho phép trùng tên với tên đã có trong DB khi bấm Save nếu có ID trên DB
        }
        
        return [
            'name'              => $usernameCondition, //Không cho phép trùng tên           
            'status'            => 'bail|in:active,inactive',
            'thumb'             =>  $thumbCondition
        ];
    }

    public function messages() //Đổi nội dung cảnh báo
    {
        return [
            'username.required'     => 'username không được để trống',
            'username.min'          => 'username là :input không hợp lệ. Độ dài phải hơn :min ký tự',
        ];
    }

    public function attributes() //Đổi tên của phần tử
{
    return [
        'description' => 'Phần mô tả',
    ];
}
}
