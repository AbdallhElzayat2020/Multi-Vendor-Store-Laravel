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


    // soft delete routes
    Route::get('categories/trash', [CategoryController::class, 'trash'])
        ->name('categories.trash');

    Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');

    Route::delete('categories/{category}/delete', [CategoryController::class, 'forceDelete'])
        ->name('categories.force-delete');

    Route::resource('categories', CategoryController::class);


    Route::resource('products', CategoryController::class);
});
