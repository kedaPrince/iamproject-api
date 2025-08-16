<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RecommendedProducts;
use App\Http\Controllers\Admin\SingleProductsController;

//use App\Http\Controllers\Admin\ProductController;
//use App\Http\Controllers\Admin\UserController;

Route::prefix('admin/')->middleware(['auth', 'isAdmin'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Deliveries
    Route::resource('deliveries', DeliveryController::class);

    // Recommended
    Route::resource('recommended', RecommendedProducts::class);

    // Orders
    Route::resource('orders', OrdersController::class);

    // Products
    Route::resource('single-products', SingleProductsController::class);

    // Users
   // Route::resource('users', UserController::class);

});