<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleValidate extends FormRequest
{
    private $table = 'article';
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
        $thumbCondition = 'bail|required|image';
        $nameCondition  = "bail|required|min:5|unique:$this->table,name"; //Không được phép trùng tên với tên đã có trong DB khi bấm Save
        
        if(!empty($id)) //Nếu có tồn tại id được gửi lên server (tức là Edit) thì set điều kiện validate khác
        {
            $thumbCondition = 'bail|image';
            $nameCondition  = "bail|required|min:5|unique:$this->table,name,$id";//Cho phép trùng tên với tên đã có trong DB khi bấm Save nếu có ID trên DB
        }
        
        return [
            'name'              => $nameCondition, //Không cho phép trùng tên
            'content'           => 'bail|required|min:5',         
            'status'            => 'bail|in:active,inactive',
            'thumb'             =>  $thumbCondition
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
        'description' => 'Phần mô tả',
    ];
}
}
