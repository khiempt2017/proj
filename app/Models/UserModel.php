<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserModel extends Model
{
    protected $table = 'user';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    private $fieldSearchAccepted = ['id', 'username']; //Những giá trị field để search được chấp nhận
    private $elementsNotAccepted = ['_token','thumb_current']; //Những giá trị không được lấy khi insert vào DB

    public function listItems($params = null, $option = null) //Lấy danh sách từ DB ra
    {
        $result = null;
        // echo "<pre style=color:red>";
        // print_r($params);
        // echo "</pre>";
        if($option['task'] == 'admin-items')
        {
            $query = $this->select('id','username','thumb','email','fullname','level','created','created_by','modified','modified_by','status'); // $this là userModel

            if($params['filter']['status'] !== 'all') // Lọc Filter
            {
                $query -> where('status', '=', $params['filter']['status']);
            }

            if($params['search']['value'] != null) // Tiến hành search nếu có dữ liệu Search
            {
                if($params['search']['field'] == 'all') //Search all
                {
                    
                    foreach($this->fieldSearchAccepted as $value)
                    {
                        $query->orWhere($value, 'LIKE', '%'.$params['search']['value'].'%');
                    }
                    
                }

                else if(in_array($params['search']['field'],$this->fieldSearchAccepted)) //Nếu có tồn tại giá trị field được cho phép mới đc search
                {
                    $query -> where($params['search']['field'], 'LIKE', '%'.$params['search']['value'].'%');
                }
            }
            
            $result = $query->paginate($params['pagination']['totalItemsPerPage']);
            
        }
        return $result;
    }

    public function getItem($params = null, $option = null) //Lấy 1 phần tử từ DB ra
    {
        $result = null;
        
        if($option['task'] == 'admin-get-item')
        {   
            
            $query  = self::select('id','username','email','fullname','level','thumb','status'); // self là userModel
            $result = $query-> where('id', '=', $params['id'])->get();  
        }

        if($option['task'] == 'user-get-item')
        {   
            $result  = self::select('id','username','email','fullname','level','thumb','status') // self là userModel
                            ->where('email', '=', $params['email'])
                            ->where('password', '=', md5($params['password']))
                            ->where('status', '=', "active")
                            ->first();  
            if($result)
            {
                $result = $result->toArray();
            }
        }
        
        return $result;
    }

    public function countItems($params = null, $option = null) // Đếm số lượng các phần tử
    {
        $result = null;
        if($option['task'] == 'admin-count-status') //thống kê số lượng của status
        {
            $result = self::select(DB::raw('count(id) as "count", status'))
                     ->groupBy('status')
                     ->get()
                     ->toArray();
            //SELECT status, COUNT(id) as count FROM user group by user.status
        }
        return $result;
    }

    public function saveItems($params = null,$option = null) //Save dữ liệu form (thêm, sửa, đổi Status)
    {
        if($option['task'] == 'change-status')
        {
            $newStatus = ($params['status'] == 'inactive') ? 'active' : 'inactive';
            DB::update('update `'.$this->table.'` set `status` = "'.$newStatus.'" where `id` = ?', [$params['id']]);
        }

        if($option['task'] == 'change-level')
        {
            $newlevel = $params['level'];
            
            DB::update('update `'.$this->table.'` set `level` = "'.$newlevel.'" where `id` = ?', [$params['id']]);
        }

        if($option['task'] == 'add-item')
        {
            $objThumb = $params['thumb']; //Lấy đối tượng thumb ra
            
            $randomString   = Str::random(7); //Tạo chuỗi random để đổi cho tấm hình
            $extension      = $objThumb->getClientOriginalExtension(); //Lấy cái extension ra
            $newThumbName   = $randomString . '.' . $extension; //Tên mới của tấm hình
            $objThumb       -> storeAs('images/'.$this->table.'',$newThumbName,'khiem_storage_image'); //Lưu hình ảnh vào đường dẫn public/images/......
            $params['thumb'] = $newThumbName; //Cập nhật lại biến để có thể đẩy lên DB.

            //Hoán đổi vị trí của key với value để tiến hành bước tiếp theo (Từ [0] => _token đổi thành ['_token'] => 0)
            $this->elementsNotAccepted = array_flip($this->elementsNotAccepted); 

            //Tiến hành lấy mảng mới mà KHÔNG LẤY các key trong mảng phía trên
            //Kết quả cuối cùng ta được mảng mới có các key trùng khớp với các column trong table để insert vào
            $params = array_diff_key($params,$this->elementsNotAccepted); 
            self::insert($params); //Thêm dữ liệu vào
        }

        if($option['task'] == 'edit-item')
        {
            if(!empty($params['thumb']))
            {
                $objThumb       = $params['thumb']; //Lấy đối tượng thumb ra
                $randomString   = Str::random(7); //Tạo chuỗi random để đổi cho tấm hình
                $extension      = $objThumb->getClientOriginalExtension(); //Lấy cái extension ra
                $newThumbName   = $randomString . '.' . $extension; //Tên mới của tấm hình

                $objThumb       -> storeAs('images/'.$this->table.'',$newThumbName,'khiem_storage_image'); //Lưu hình ảnh vào đường dẫn public/images/......
                $params['thumb'] = $newThumbName; //Cập nhật lại biến để có thể đẩy lên DB.
                Storage::disk('khiem_storage_image')->delete('images/'.$this->table.'/'. $params['thumb_current'].''); //Xóa tấm hình cũ
            }
           
            //Hoán đổi vị trí của key với value để tiến hành bước tiếp theo (Từ [0] => _token đổi thành ['_token'] => 0)
            $this->elementsNotAccepted = array_flip($this->elementsNotAccepted); 

            //Tiến hành lấy mảng mới mà KHÔNG LẤY các key trong mảng phía trên
            //Kết quả cuối cùng ta được mảng mới có các key trùng khớp với các column trong table để insert vào
            $params = array_diff_key($params,$this->elementsNotAccepted); 
            
            self::where('id', $params['id'])
                ->update($params);
        }
    }

    public function deleteItems($params = null,$option = null)
    {
        if($option['task'] == 'delete-user')
        {
            $query  = self::select('thumb'); // self là userModel
            $result = $query-> where('id', '=', $params['id'])->get()->toArray(); //Lấy tấm hình
            $thumbName = $result[0]['thumb']; //Đặt lại tên biến cho tấm hình
            DB::table('user')->where('id', '=', $params['id'])->delete(); //Xóa dữ liệu trên DB
            Storage::disk('khiem_storage_image')->delete('images/'.$this->table.'/'.$thumbName.''); //Xóa tấm hình
        }
    }

    //========================================== PHẦN LOGIN Ở FRONT-END ===================================================
    
    public function login($params = null,$option = null)
    {
        
    }
}
