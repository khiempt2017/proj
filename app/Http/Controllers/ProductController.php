<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use App\Models\ProductModel as MainModel;
use App\Http\Requests\ProductValidate as MainValidate;


class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $product = MainModel::create($request->all());
        return response()->json($product);
    }

    public function updateProduct(Request $request, $id){
        $product  = DB::table('products')->where('id',$request->input('id'))->get();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();
        $response["products"] = $product;
        $response["success"] = 1;
        return response()->json($response);
    }  

    public function deleteProduct($id)
    {
        $product  = DB::table('products')->where('id',$request->input('id'))->get();
        $product->delete();
        return response()->json('Removed successfully.');
    }

    public function index()
    {
        
        $products  = MainModel::all();
        $response["products"] = $products;
        // $result = response()->json($response);
        
        
        $result = json_encode($response["products"]);
        echo "<pre style=color:red>";
        print_r($result);
        echo "</pre>";

        echo "<pre style=color:red>";
        print_r(json_decode($result));
        echo "</pre>";
        return $result;
    }
    
}
