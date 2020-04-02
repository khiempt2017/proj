<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use App\Models\IndexModel as MainModel;


class TestController extends Controller
{
    private $pathViewController = 'default/pages/index/';
    private $controllerName     = 'index';
    private $model;
    private $params = [];
    public function __construct()
    {
        $this->model = new MainModel;
        View::share('controllerName', $this->controllerName); //Share biến $controllerName ra toàn bộ function 
    }
    public function index(Request $request)
    {
        
        $arr1 = [   
                    'test1' => 'php', 
                    'test2' => 'js'         
                ];

        $arr2 = [   
                    0 => 'java', 
                    1 => 'jquery'         
                ];


        $newArr1 = array();
        $index = 0;
        foreach ($arr1 as $key => $value)
        {
            echo '<h3 style="color:red">' .$index. '</h3>';
            
            $newArr1[$value] = $arr2[$index];
            
            $index++;
        }

        echo "<pre style=color:red>";
        print_r($newArr1);
        echo "</pre>";
                                           
    }

    
    
}