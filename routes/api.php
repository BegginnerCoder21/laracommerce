<?php

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


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //probleme rencontré car dans api.php apiResources venais apres /products/count
    Route::get('products/count' , [\App\Http\Controllers\Api\CartController::class, 'count'])->name('products.count');
    Route::apiResource('products',\App\Http\Controllers\Api\CartController::class);

});
