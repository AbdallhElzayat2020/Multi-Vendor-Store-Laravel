<?php

use App\Http\Controllers\Dashboard\Categories\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;






Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    'middleware' => ['auth', 'verified']
], function () {

    Route::resource('categories', CategoryController::class);

    Route::resource('products', CategoryController::class);
});
