<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/category', [CategoryController::class, 'index']);

Route::post('/getByCategory', [CategoryController::class, 'getByCategory']);

Route::get('/product', [ProductController::class, 'index']);

Route::post('/detail', [ProductController::class, 'detail']);
