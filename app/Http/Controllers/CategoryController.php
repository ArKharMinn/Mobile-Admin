<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return response()->json(['message' => 'success', 'data' => $data], 200);
    }

    public function getByCategory(Request $request)
    {
        $id = $request->id;

        $data = Product::where('category_id', $id)->get();
        return response()->json(['message' => 'success', 'data' => $data], 200);
    }
}
