<?php
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', Api\CategoryController::class);
Route::apiResource('products', Api\ProductController::class);
Route::apiResource('attributes', Api\AttributeController::class);

