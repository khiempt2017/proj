<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    private $pathViewController = 'admin/pages/dashboard/';
    private $controllerName     = 'dashboard';
    public function __construct()
    {
        // Sharing is caring
        View::share('controllerName', $this->controllerName); //Share biến $controllerName ra toàn bộ function 
    }
    public function index()
    {
        return view($this->pathViewController.'index', );
    }
}