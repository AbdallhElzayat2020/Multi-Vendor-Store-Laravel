<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use  App\Http\Controllers\SocialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('products', [ProductsController::class, 'index'])->name('products.index');

    Route::get('products/{product:slug}', [ProductsController::class, 'show'])->name('products.show');

    Route::resource('cart', CartController::class);


    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');

    Route::post('/checkout', [CheckoutController::class, 'store']);


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});


Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('auth.socialite.redirect');

Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('auth.socialite.callback');

//get Data for user when login with social media from His token
Route::get('auth/{provider}/user', [SocialController::class, 'index']);


//require __DIR__ . '/auth.php';

require __DIR__ . '/dashboard.php';

// Auth::user();
