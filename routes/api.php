<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

route::post('product-update/{id}' , [ProductController::class, 'update']);
route::post('banners-update/{id}' , [BannerController::class, 'update']);
Route::resource('product-types', ProductTypeController::class);
Route::resource('product', ProductController::class);
Route::resource('banners', BannerController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');