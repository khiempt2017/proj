<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('category', function () {
    return view('category');
});



// Route::get('admin/user/index', function () {
//     return view('admin/user/index');
// });

//Phần định nghĩa prefix

//Cách 1
//$prefixAdmin = config('define.url.prefix_admin'); // Định nghĩa trong config => define.php , đường dẫn đến giá trị prefix_admin là define=>url=>prefix_admin

//Cách 2
$prefixAdmin    = Config::get('define.url.prefix_admin', 'admin'); 
$prefixDefault  = Config::get('define.url.prefix_default', 'default'); 


Route::group(['prefix' => $prefixAdmin,'namespace' => 'admin','middleware'=>['check.admin']], function ()   { //Phải có use mới gọi được biến prefixSlider từ bên ngoài

    //================================================= DASHBOARD =================================================
    $prefix             = "dashboard";
    $controllerName     = 'dashboard';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/',                                         ['as' => $controllerName,                 'uses' => $controller.'index']);
        Route::get('form/{id?}',                                ['as' => $controllerName.'/form',         'uses' => $controller.'form']);
        Route::get('delete/{id}',                               ['as' => $controllerName.'/delete',       'uses' => $controller.'delete']);
        Route::get('change-status-{status}/{id}',               ['as' => $controllerName.'/status',       'uses' => $controller.'status']);
    });

    //================================================= SLIDER =================================================
    $prefix             = "slider";
    $controllerName     = 'slider';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";

        // Route::get('/',                                 'SliderController@index');
        //Route::get('/',                                 $controller.'index');
        Route::get('/',                                         ['as' => $controllerName,                 'uses' => $controller.'index']);
        Route::get('form/{id?}',                                ['as' => $controllerName.'/form',         'uses' => $controller.'form']);
        Route::post('save/',                                    ['as' => $controllerName.'/save',         'uses' => $controller.'save']);
        Route::get('delete/{id}',                               ['as' => $controllerName.'/delete',       'uses' => $controller.'delete']);
        Route::get('change-status-{status}/{id}',               ['as' => $controllerName.'/status',       'uses' => $controller.'status']);
    });

    //================================================= CATEGORY =================================================
    $prefix             = "category";
    $controllerName     = 'category';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";

        // Route::get('/',                                 'SliderController@index');
        //Route::get('/',                                 $controller.'index');
        Route::get('/',                                         ['as' => $controllerName,                 'uses' => $controller.'index']);
        Route::get('form/{id?}',                                ['as' => $controllerName.'/form',         'uses' => $controller.'form']);
        Route::post('save/',                                    ['as' => $controllerName.'/save',         'uses' => $controller.'save']);
        Route::get('delete/{id}',                               ['as' => $controllerName.'/delete',       'uses' => $controller.'delete']);
        Route::get('change-status-{status}/{id}',               ['as' => $controllerName.'/status',       'uses' => $controller.'status']);
        Route::get('change-ishome-{status}/{id}',               ['as' => $controllerName.'/ishome',       'uses' => $controller.'ishome']);
        Route::get('change-display-{display}/{id}',             ['as' => $controllerName.'/display',      'uses' => $controller.'display']);
    });

    //================================================= ARTICLE =================================================
    $prefix             = "article";
    $controllerName     = 'article';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";

        // Route::get('/',                                 'SliderController@index');
        //Route::get('/',                                 $controller.'index');
        Route::get('/',                                         ['as' => $controllerName,                 'uses' => $controller.'index']);
        Route::get('form/{id?}',                                ['as' => $controllerName.'/form',         'uses' => $controller.'form']);
        Route::post('save/',                                    ['as' => $controllerName.'/save',         'uses' => $controller.'save']);
        Route::get('delete/{id}',                               ['as' => $controllerName.'/delete',       'uses' => $controller.'delete']);
        Route::get('change-status-{status}/{id}',               ['as' => $controllerName.'/status',       'uses' => $controller.'status']);
        Route::get('change-ishome-{status}/{id}',               ['as' => $controllerName.'/ishome',       'uses' => $controller.'ishome']);
        Route::get('change-type-{type}/{id}',                   ['as' => $controllerName.'/type',         'uses' => $controller.'type']);
    });

    $prefix             = "user";
    $controllerName     = 'user';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";

        // Route::get('/',                                 'SliderController@index');
        //Route::get('/',                                 $controller.'index');
        Route::get('/',                                         ['as' => $controllerName,                 'uses' => $controller.'index']);
        Route::get('form/{id?}',                                ['as' => $controllerName.'/form',         'uses' => $controller.'form']);
        Route::post('save/',                                    ['as' => $controllerName.'/save',         'uses' => $controller.'save']);
        Route::get('delete/{id}',                               ['as' => $controllerName.'/delete',       'uses' => $controller.'delete']);
        Route::get('change-status-{status}/{id}',               ['as' => $controllerName.'/status',       'uses' => $controller.'status']);
        Route::get('change-level-{level}/{id}',                 ['as' => $controllerName.'/level',        'uses' => $controller.'level']);
    });

    
});

    //================================================= Home =================================================
    $prefix             = "home";
    $controllerName     = 'index';
    Route::group(['prefix' => $prefix], function () use($controllerName) 
    {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/',                                         ['as' => $controllerName,                      'uses' => $controller.'index']);
        Route::get('bai-viet/{id}/{category_id}',               ['as' => 'home/article',                       'uses' => $controller.'article']);
        Route::get('danh-muc/{id}/{category_name}.html',        ['as' => 'home/category',                      'uses' => $controller.'category']);
        Route::get('not-permission',                            ['as' => 'notify',                             'uses' => $controller.'notify']);
    

    //================================================= Phần User =================================================
        $prefix             = "auth";
        $controllerName     = 'user';
        Route::group(['prefix' => $prefix], function () use($controllerName) 
        {
            $controller = ucfirst($controllerName) . "Controller@";

            // Route::get('/',                                 'UserController@index');
            //Route::get('/',                                 $controller.'index');
            Route::get('/',                               ['as' => $controllerName.'/index/login',   'uses' => $controller.'indexLogin'])->middleware('check.login');
            Route::post('login',                          ['as' => $controllerName.'/login',         'uses' => $controller.'login']);
            Route::get('logout',                          ['as' => $controllerName.'/logout',        'uses' => $controller.'logout']);
        });
    });

    //================================================= Test =================================================
    $prefix             = "test";
    $controllerName     = 'test';
    Route::group(['prefix' => $prefix,'namespace' => 'Test'], function () use($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";
        Route::get('/',                                         ['as' => $controllerName,                      'uses' => $controller.'index']);
        
    });

   

    