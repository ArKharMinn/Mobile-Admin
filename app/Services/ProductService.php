<?php

namespace App\Services;

use App\Http\Requests\SearchProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    public function index()
    {
        return Product::with('category')->get();
    }

    public function detail(Request $request)
    {
        $id = $request->id;

        return  Product::find($id);
    }

    public function search(SearchProductRequest $request)
    {
        return Product::where('name', 'like', '%' . $request->input('search') . '%')->with('category')
            ->get();
    }
}
