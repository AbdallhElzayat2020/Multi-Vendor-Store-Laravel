<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::guard('sanctum')->user();
});


Route::apiResource('products', ProductsController::class);


Route::post('auth/access-token', [AccessTokenController::class, 'store'])->middleware('guest:sanctum');

Route::delete('auth/access-token/{token?}', [AccessTokenController::class, 'destroy'])->middleware('auth:sanctum');
