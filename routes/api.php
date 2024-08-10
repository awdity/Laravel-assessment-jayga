<?php
use App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductSearchController;


Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('attributes', AttributeController::class);
Route::get('/products/search',[ProductSearchController::class, 'search']);
Route::get('/test', function () {
    return response()->json(['message' => 'Hello, world!']);
});

