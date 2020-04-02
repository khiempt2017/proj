<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryModel extends Model
{
    protected $table = 'category';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    private $fieldSearchAccepted = ['id', 'name']; //Những giá trị field để search được chấp nhận
    private $elementsNotAccepted = ['_token']; //Những giá trị không được lấy khi insert vào DB

    public function listItems($params = null, $option = null) //Lấy danh sách từ DB ra
    {
        $result = null;
        
        if($option['task'] == 'admin-items')
        {
            $query = $this->select('id','name','created','created_by','modified','modified_by','status','is_home','display'); // $this là categoryModel

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
            
            $query  = self::select('id','name','status'); // self là categoryModel
            $result = $query-> where('id', '=', $params['id'])->get();  
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
            //SELECT status, COUNT(id) as count FROM category group by category.status
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

        if($option['task'] == 'change-ishome-status')
        {
            $newStatus = ($params['status'] == 1) ? 0 : 1;
            
            DB::update('update `'.$this->table.'` set `is_home` = "'.$newStatus.'" where `id` = ?', [$params['id']]);
        }

        if($option['task'] == 'change-display-status')
        {
            DB::update('update `'.$this->table.'` set `display` = "'.$params['display'].'" where `id` = ?', [$params['id']]);
        }

        if($option['task'] == 'add-item')
        {
            //Hoán đổi vị trí của key với value để tiến hành bước tiếp theo (Từ [0] => _token đổi thành ['_token'] => 0)
            $this->elementsNotAccepted = array_flip($this->elementsNotAccepted); 

            //Tiến hành lấy mảng mới mà KHÔNG LẤY các key trong mảng phía trên
            //Kết quả cuối cùng ta được mảng mới có các key trùng khớp với các column trong table để insert vào
            $params = array_diff_key($params,$this->elementsNotAccepted); 
            self::insert($params); //Thêm dữ liệu vào
        }

        if($option['task'] == 'edit-item')
        {
            
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
        if($option['task'] == 'delete-category')
        {
            DB::table('category')->where('id', '=', $params['id'])->delete(); //Xóa dữ liệu trên DB
            
        }
    }
}
