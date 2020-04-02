<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


    
    $prefix             = "product";
    $controllerName     = 'product';
    Route::group(['prefix' => $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName) . "Controller@";

        // Route::get('/',                                 'productController@index');
        //Route::get('/',                                 $controller.'index');
        Route::get('/',                                         ['as' => $controllerName,                 'uses' => $controller.'index']);
                // Lấy thông tin sản phẩm theo id
        Route::get('product/{id}', 'Api\ProductController@show')->name('product.show');

        // Thêm sản phẩm mới
        Route::post('product', 'Api\ProductController@store')->name('product.store');

        // Cập nhật thông tin sản phẩm theo id
        # Sử dụng put nếu cập nhật toàn bộ các trường
        Route::put('product/{id}', 'Api\ProductController@update')->name('product.update');
        # Sử dụng patch nếu cập nhật 1 vài trường
        Route::patch('product/{id}', 'Api\ProductController@update')->name('product.update');

        // Xóa sản phẩm theo id
        Route::delete('product/{id}', 'Api\ProductController@destroy')->name('product.destroy');
    });

