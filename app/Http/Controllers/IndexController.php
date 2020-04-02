<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use App\Models\IndexModel as MainModel;
use App\Http\Controllers\Controller;

class IndexController extends Controller
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
        $sliderItems            = $this->model->getItems($this->params,'slider');
        $categoryItemsMenu      = $this->model->getItems($this->params,'category-menu');
        $categoryItemsIsHome    = $this->model->getItems($this->params,'category-ishome');
        
        foreach($categoryItemsIsHome as $key => $value)
        {
            //Lấy các bài viết thuộc categoryItemsIsHome tạo 1 mảng mới là articles nằm bên trong $value rồi đổ dữ liệu vào 
            $this->params['category_id'] = $value->id;
            $value->articles = $this->model->getItems($this->params,'articles-in-category'); //Lấy những bài viết thuộc category đó rồi đổ vào mảng articles mới tạo;
        }
        
        
        $featuredArticle        = $this->model->getItems($this->params,'article-featured'); //Lấy những bài viết nổi bật
        $articlesNewest         = $this->model->getItems($this->params,'articles-newest'); //Lấy những bài viết mới nhất
        
        return view($this->pathViewController.'index', ['params'                => $this->params, 
                                                        'sliderItems'           => $sliderItems,  
                                                        'categoryItemsMenu'     => $categoryItemsMenu,    
                                                        'categoryItemsIsHome'   => $categoryItemsIsHome, 
                                                        'featuredArticleItems'  => $featuredArticle,    
                                                        'articlesNewest'        => $articlesNewest,                                                        
                                                        ]); //Truyền các giá trị ra ngoài View
    }

    public function article(Request $request)
    {
        
        $this->params['id']                 = $request->id;
        $this->params['category_id']        = $request->category_id;
        $sliderItems            = $this->model->getItems($this->params,'slider');
        $categoryItemsMenu      = $this->model->getItems($this->params,'category-menu');
        $categoryItemsIsHome    = $this->model->getItems($this->params,'category-ishome');
        $featuredArticle        = $this->model->getItems($this->params,'article-featured'); //Lấy những bài viết nổi bật
        $articlesItems          = $this->model->getItems($this->params,'articles-items'); //Lấy ra bài viết cụ thể
        $articlesRelated        = $this->model->getItems($this->params,'articles-related'); //Lấy những bài viết liên quan có category trùng với category của bài viết trên
        $articlesNewest         = $this->model->getItems($this->params,'articles-newest'); //Lấy những bài viết mới nhất

        return view('default/pages/article/index', [    'params'                => $this->params, 
                                                        'sliderItems'           => $sliderItems,  
                                                        'categoryItemsMenu'     => $categoryItemsMenu,    
                                                        'categoryItemsIsHome'   => $categoryItemsIsHome, 
                                                        'featuredArticleItems'  => $featuredArticle,    
                                                        'articlesItems'         => $articlesItems, 
                                                        'articlesRelated'       => $articlesRelated, 
                                                        'articlesNewest'        => $articlesNewest,                                                 
                                                    ]); //Truyền các giá trị ra ngoài View
        

    }

    public function category(Request $request)
    {
        $this->params['category_id']     = $request->id;
        $sliderItems            = $this->model->getItems($this->params,'slider');
        $categoryItemsMenu      = $this->model->getItems($this->params,'category-menu');
        $categoryItemsIsHome    = $this->model->getItems($this->params,'category-ishome');
        $featuredArticle        = $this->model->getItems($this->params,'article-featured'); //Lấy những bài viết nổi bật
        $articlesInCategory     = $this->model->getItems($this->params,'articles-in-category'); //Lấy những bài viết thuộc category nào đó
        $articlesNewest         = $this->model->getItems($this->params,'articles-newest'); //Lấy những bài viết mới nhất
        
        return view('default/pages/category/index', [   'params'                => $this->params, 
                                                        'sliderItems'           => $sliderItems,  
                                                        'categoryItemsMenu'     => $categoryItemsMenu,    
                                                        'categoryItemsIsHome'   => $categoryItemsIsHome, 
                                                        'featuredArticleItems'  => $featuredArticle, 
                                                        'articlesInCategory'    => $articlesInCategory,
                                                        'articlesNewest'        => $articlesNewest,                                                
                                                    ]); //Truyền các giá trị ra ngoài View
    }

    public function notify(Request $request)
    {
        $sliderItems            = $this->model->getItems($this->params,'slider');
        $categoryItemsMenu      = $this->model->getItems($this->params,'category-menu');
        $featuredArticle        = $this->model->getItems($this->params,'article-featured'); //Lấy những bài viết nổi bật
        $articlesNewest         = $this->model->getItems($this->params,'articles-newest'); //Lấy những bài viết mới nhất
        
        return view('default/pages/notify/index',      ['params'                => $this->params, 
                                                        'sliderItems'           => $sliderItems,  
                                                        'categoryItemsMenu'     => $categoryItemsMenu,                                        
                                                        'featuredArticleItems'  => $featuredArticle,    
                                                        'articlesNewest'        => $articlesNewest,                                                        
                                                        ]); //Truyền các giá trị ra ngoài View
    }
}