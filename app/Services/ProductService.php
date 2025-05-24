<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

Class ProductService{
public function index()
    {
       return Product::all();
    }

    public function detail(Request $request)
    {
        $id = $request->id;

      return  Product::find($id);
    }
}
