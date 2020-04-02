<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class IndexModel extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    
    public function getItems($params = null, $option = null) //Lấy danh sách từ DB ra
    {
        if($option === "slider")
        {
            $result = DB::table('slider')->select('id', 'name as slider_name','description','link','thumb','status')
            ->where('status', '=', 'active')
            ->get()
            ->toArray();
            return $result;
        }

        if($option === "category-menu")
        {
            $result = DB::table('category')->select('id', 'name','display')
            ->where('status', '=', 'active')
            ->get()
            ->toArray();
            return $result;
        }

        if($option === "category-ishome")
        {
            $result = DB::table('category')->select('id', 'name','display')
            ->where('status', '=', 'active')
            ->where('is_home', '=', '1')
            ->get()
            ->toArray();
            return $result;
        }

        if($option === "article-featured") //Bài viết nổi bật
        {
            $result = DB::table('article as a')->select('a.id','a.name','a.created','a.created_by','a.publish_at',
            'a.status','a.category_id','a.type','a.thumb','c.name as category_name') 
            ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
            ->where('a.status', '=', 'active')
            ->where('a.type', '=', 'feature')
            ->orderBy('a.id','desc')
            ->take(3) //Chỉ lấy 3 cái
            ->get()
            ->toArray();
            return $result;
        }

        if($option === "articles-in-category")
        {
            $result = DB::table('article as a')->select('a.id','a.name','a.created','a.created_by','a.publish_at',
            'a.status','a.category_id','a.type','a.thumb','a.content') 
 
            ->where('a.status', '=', 'active')
            ->where('a.category_id', '=', $params['category_id'])
            ->orderBy('a.id','desc')
            ->take(4) //Chỉ lấy 4 cái
            ->get()
            ->toArray();
            return $result;
        }

        if($option === "articles-items")
        {
            $article_id     = $params['id'];
            
            $result = DB::table('article as a')->select('a.id','a.name','a.created','a.created_by','a.publish_at',
            'a.status','a.category_id','a.type','a.thumb','a.content','c.name as category_name') 
            ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
            ->where('a.status', '=', 'active')
            ->where('a.id', '=', $article_id)
            ->orderBy('a.id','desc')
            ->get()
            ->toArray();
            return $result;
        }

        if($option === "articles-related")
        {
            $category_id     = $params['category_id'];
            
            $result = DB::table('article as a')->select('a.id','a.name','a.created','a.created_by','a.publish_at',
            'a.status','a.category_id','a.type','a.thumb','a.content') 
            ->where('a.status', '=', 'active')
            ->where('a.category_id', '=', $category_id)
            ->orderBy('a.id','desc')
            ->take(5) //Chỉ lấy 5 cái
            ->get()
            ->toArray();
            return $result;
        }

        if($option === "articles-newest")
        {
            
            $result = DB::table('article as a')->select('a.id','a.name','a.created','a.created_by','a.publish_at',
            'a.status','a.category_id','a.type','a.thumb','a.content','c.name as category_name') 
            ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
            ->where('a.status', '=', 'active')
            ->orderBy('a.id','desc')
            ->take(4) //Chỉ lấy 5 cái
            ->get()
            ->toArray();
            return $result;
        }

        
    }

    
}
