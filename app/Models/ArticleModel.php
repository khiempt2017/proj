<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleModel extends Model
{
    protected $table = 'article as a';
    private $tableName = 'article';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    private $fieldSearchAccepted = ['id', 'name']; //Những giá trị field để search được chấp nhận
    private $elementsNotAccepted = ['_token','thumb_current']; //Những giá trị không được lấy khi insert vào DB

    public function listItems($params = null, $option = null) //Lấy danh sách từ DB ra
    {
        $result = null;
        
        if($option['task'] == 'admin-items')
        {
            $query = $this->select('a.id','a.name','a.created','a.created_by','a.modified','a.modified_by',
            'a.status','a.category_id','a.publish_at','a.type','a.thumb','c.name as category_name'); // $this là aModel
            $query->leftJoin('category as c', 'a.category_id', '=', 'c.id');
            
            if($params['filter']['status'] !== 'all') // Lọc Filter
            {
                $query -> where('a.status', '=', $params['filter']['status']);
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
            
            $query  = self::select('id','category_id','name','created','created_by','modified','modified_by','status','category_id','content','publish_at','type','thumb'); // self là articleModel
            $result = $query-> where('id', '=', $params['id'])->get();  
        }

        if($option['task'] == 'admin-get-category-list')
        {   
            $result = DB::table('category')->select('id','name')->get()->toArray(); 
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
            //SELECT status, COUNT(id) as count FROM article group by article.status
        }
        return $result;
    }

    public function saveItems($params = null,$option = null) //Save dữ liệu form (thêm, sửa, đổi Status)
    {
        if($option['task'] == 'change-status')
        {
            $newStatus = ($params['status'] == 'inactive') ? 'active' : 'inactive';
            DB::update('update `'.$this->tableName.'` set `status` = "'.$newStatus.'" where `id` = ?', [$params['id']]);
        }

        if($option['task'] == 'change-type')
        {
            $newType = ($params['type'] == 'feature') ? 'normal' : 'feature';
            DB::update('update `'.$this->tableName.'` set `type` = "'.$newType.'" where `id` = ?', [$params['id']]);
        }

        

        if($option['task'] == 'add-item')
        {
            $objThumb = $params['thumb']; //Lấy đối tượng thumb ra
            
            $randomString   = Str::random(7); //Tạo chuỗi random để đổi cho tấm hình
            $extension      = $objThumb->getClientOriginalExtension(); //Lấy cái extension ra
            $newThumbName   = $randomString . '.' . $extension; //Tên mới của tấm hình
            $objThumb       -> storeAs('images/'.$this->tableName.'',$newThumbName,'khiem_storage_image'); //Lưu hình ảnh vào đường dẫn public/images/......
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

                $objThumb       -> storeAs('images/'.$this->tableName.'',$newThumbName,'khiem_storage_image'); //Lưu hình ảnh vào đường dẫn public/images/......
                $params['thumb'] = $newThumbName; //Cập nhật lại biến để có thể đẩy lên DB.
                Storage::disk('khiem_storage_image')->delete('images/'.$this->tableName.'/'. $params['thumb_current'].''); //Xóa tấm hình cũ
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
        if($option['task'] == 'delete-article')
        {
            $query  = self::select('thumb'); // self là articleModel
            $result = $query-> where('id', '=', $params['id'])->get()->toArray(); //Lấy tấm hình
            
            DB::table('article')->where('id', '=', $params['id'])->delete(); //Xóa dữ liệu trên DB
            
        }
    }
}
