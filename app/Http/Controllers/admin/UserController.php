<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use App\Models\UserModel as MainModel;
use App\Http\Requests\UserValidate as MainValidate;

class UserController extends Controller
{
    private $pathViewController = 'admin/pages/user/';
    private $controllerName     = 'user';
    private $model;
    private $params = [];
    public function __construct()
    {
        $this->model = new MainModel;
        $this->params['pagination']['totalItemsPerPage'] = 10; //Số phần tử trên 1 trang là 3, truyền params này vào model
        
        View::share('controllerName', $this->controllerName); //Share biến $controllerName ra toàn bộ function 
    }
    public function index(Request $request)
    {
        die("function die is call");
        $btnStatus              = $request->input('filter_status', 'all'); // Tương đương lấy giá trị trên $_GET về, mặc định nếu ko có biến filter_status trên URL thì sẽ là all
        $searchValue            = $request->input('search_value'); // Lấy giá trị search trên URL về
        $searchField            = $request->input('search_field') != null ? $request->input('search_field') : 'all' ; // Lấy giá trị của field search trên URL về, nếu ko có thì mặc định là search all
        $currentPage            = (!empty($request->page)) ? $request->page : null;
        
        $this->params['filter']['status']   = $btnStatus;
        $this->params['search']['field']    = $searchField;
        $this->params['search']['value']    = $searchValue;
        
        $items              = $this->model->listItems($this->params,['task' => 'admin-items']);
        $countStatus        = $this->model->countItems($this->params,['task' => 'admin-count-status']);
        
        return view($this->pathViewController.'index', ['params'        => $this->params, 
                                                        'items'         => $items , 
                                                        'countStatus'   => $countStatus,
                                                        'page'          => $currentPage,
                                                        ]); //Truyền các giá trị ra ngoài View
    }

    public function form(Request $request)
    {
        $items = null;
        
        if($request->id !== null)
        {
            $this->params['id']   = $request->id;
            $items = $this->model->getItem($this->params,['task' => 'admin-get-item']);
           
        }
        
        return view($this->pathViewController.'form' , 
        [   
            'items'     => $items,    
                                                  
        ]);
    }

    public function save(MainValidate $request)
    {
        if($request->method() == 'POST')
        {
            $items = null;
            $params = $request->all(); //Lấy toàn bộ dữ liệu đã submit từ POST đổ vào params     
            
            $task = "add-item";
            $notify = "Đã thêm dữ liệu thành công";
            
            if($params['id'] != null)
            {
                $task = "edit-item";
                $notify = "Đã sửa dữ liệu thành công";
            }
            
            $this->model->saveItems($params,['task' => $task]);
            
        }
        return redirect()->route('user')->with('notify_action', $notify); //Tạo ra câu thông báo khi redirect xong
    }

    public function delete(Request $request)
    {   
        $this->params['id'] = $request->id;

        $this->model->deleteItems($this->params,['task' => 'delete-user']);
        return redirect()->route('user')->with('notify_action', 'Đã xóa thành công'); //Tạo ra câu thông báo khi redirect xong
    }

    public function status(Request $request)
    {   
        $this->params['status'] = $request->status;
        $this->params['id']     = $request->id;
        
        echo $currentPage = $request->page;
        
        $this->model->saveItems($this->params,['task' => 'change-status']);
        
        return redirect()->route('user')->with('notify_action', 'Đã cập nhật trạng thái thành công'); //Tạo ra câu thông báo khi redirect xong
    }



    public function level(Request $request)
    {   
        $this->params['level']  = $request->level;
        
        $this->params['id']     = $request->id;
        $this->model->saveItems($this->params,['task' => 'change-level']);
        
        return redirect()->route("user")->with('notify_action', 'Đã cập nhật quyền hạn user ngoài trang chủ thành công'); //Tạo ra câu thông báo khi redirect xong
    }
}