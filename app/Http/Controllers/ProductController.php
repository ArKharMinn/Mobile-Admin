<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     protected $product;

    public function __construct(ProductService $product)
    {
        $this->product = $product;

    }
     public function index()
    {
       $data=$this->product->index();
               return response()->json(['message' => 'success', 'data' => $data], 200);

    }

    public function detail(Request $request)
    {
        $data=$this->product->detail($request);
                return response()->json(['message' => 'success', 'data' => $data], 200);

    }

}
