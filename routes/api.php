<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SingleProductsController;
use App\Http\Controllers\Api\RecommendedController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\DeliveriesController;
use App\Http\Controllers\Api\CategoryController;


Route::apiResource('single-products', SingleProductsController::class);
Route::apiResource('recommended', RecommendedController::class);
Route::apiResource('orders', OrdersController::class);
Route::apiResource('deliveries', DeliveriesController::class);
Route::apiResource('categories', CategoryController::class);



Route::get('/user', function (Request $request) { return $request->user();})->middleware('auth:sanctum');