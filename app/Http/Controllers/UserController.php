<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use App\Models\UserModel as MainModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\HomeLoginValidate as LoginValidate;
class UserController extends Controller
{
    private $pathViewController = 'default/pages/user/';
    private $controllerName     = 'user';
    private $model;
    private $params = [];
    public function __construct()
    {
        $this->model = new MainModel;
        View::share('controllerName', $this->controllerName); //Share biến $controllerName ra toàn bộ function 
    }
    public function indexLogin(Request $request)
    {
        
        
        return view($this->pathViewController.'login',  ['params'               => $this->params, 
                                                                                                                   
                                                        ]); //Truyền các giá trị ra ngoài View
    }

    public function login(LoginValidate $request)
    {
        $this->params = $request->all();
        $userItems = $this->model->getItem($this->params, ['task'=>'user-get-item']);
        
        if(!$userItems)
        {
            $notify = "Tên đăng nhập hoặc mật khẩu không chính xác";
            return redirect()->route('user')->with('notify_action', $notify); //redirect về trang đăng nhập khi đăng nhập KHÔNG thành công
        }
        
        $request->session()->put('userInfo', $userItems); //Tạo một session lưu thông tin user sau khi login thành công
        
        
        return redirect()->route('index'); //redirect về trang chủ khi đăng nhập thành công
    }

    public function logout(Request $request)
    {
        $request->session()->forget('userInfo'); //xóa session
        return redirect()->route('index'); //redirect về trang chủ khi Logout thành công
    }
}