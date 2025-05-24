<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $category;

    public function __construct(CategoryService $category)
   {
    $data=$this->category= $category;
     return response()->json(['message' => 'success', 'data' => $data], 200);

   }

   public function index(){
    $data=$this->category->index();
            return response()->json(['message' => 'success', 'data' => $data], 200);

   }

   public function getByCategory(Request $request){
    $data =$this->category->getCategory($request);
            return response()->json(['message' => 'success', 'data' => $data], 200);

   }


}
