<?php

use App\Http\Controllers\Dashboard\Categories\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    'middleware' => ['auth', 'auth.type:super-admin,admin'],
], function () {

    // soft delete routes
    Route::get('categories/trash', [CategoryController::class, 'trash'])
        ->name('categories.trash');

    Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');

    Route::delete('categories/{category}/delete', [CategoryController::class, 'forceDelete'])
        ->name('categories.force-delete');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
