<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return response()->json(['message' => 'success', 'data' => $data], 200);
    }

    public function detail(Request $request)
    {
        $id = $request->id;

        $data = Product::find($id);
        return response()->json(['message' => 'success', 'data' => $data], 200);
    }
}
