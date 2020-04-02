<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryValidate extends FormRequest
{
    private $table = 'category';
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
        
        $nameCondition  = "bail|required|min:5|unique:$this->table,name"; //Không được phép trùng tên với tên đã có trong DB khi bấm Save
        
        if(!empty($id)) //Nếu có tồn tại id được gửi lên server (tức là Edit) thì set điều kiện validate khác
        {
            
            $nameCondition  = "bail|required|min:5|unique:$this->table,name,$id";//Cho phép trùng tên với tên đã có trong DB khi bấm Save nếu có ID trên DB
        }
        
        return [
            'name'              => $nameCondition, //Không cho phép trùng tên
                      
            'status'            => 'bail|in:active,inactive',
        ];
    }

    public function messages() //Đổi nội dung cảnh báo
    {
        return [
            'name.required'     => 'Name không được để trống',
            'name.min'          => 'Name là :input không hợp lệ. Độ dài phải hơn :min ký tự',
        ];
    }

    public function attributes() //Đổi tên của phần tử
{
    return [
        
    ];
}
}
