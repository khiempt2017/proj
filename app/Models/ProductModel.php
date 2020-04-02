<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductModel extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    private $fieldSearchAccepted = ['id', 'description', 'link', 'name']; //Những giá trị field để search được chấp nhận
    private $elementsNotAccepted = ['_token','thumb_current']; //Những giá trị không được lấy khi insert vào DB

    
}
