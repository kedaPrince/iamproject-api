<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware(['auth','isAdmin'])->group(function(){
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});