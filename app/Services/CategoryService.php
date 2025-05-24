<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

Class CategoryService{
    public function index(){
        return Category::where('status','active')->get();
    }

    public function getCategory(Request $request){
       return Product::where('category_id',$request->id)->get();

    }
}
