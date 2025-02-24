<?php

use App\Http\Controllers\Dashboard\Categories\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Products\ImportProductsController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\Profile\ProfileController;
use App\Http\Controllers\Dashboard\Roles\RolesController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:admin,web'],
    'as' => 'dashboard.',
    'prefix' => 'admin/dashboard',
], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    // soft delete routes
    Route::get('categories/trash', [CategoryController::class, 'trash'])
        ->name('categories.trash');

    Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');

    Route::delete('categories/{category}/delete', [CategoryController::class, 'forceDelete'])
        ->name('categories.force-delete');

    Route::resource('categories', CategoryController::class);

    Route::get('products/import', [ImportProductsController::class, 'create'])->name('products.import');
    Route::post('products/import', [ImportProductsController::class, 'store'])->name('products.import');
    Route::resource('products', ProductController::class);

    Route::resource('roles', RolesController::class);

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

});
