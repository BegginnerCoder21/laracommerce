<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('products',[\App\Http\Controllers\ProductController::class,'index'])->name('product.list');
    Route::get('formpayement',\App\Http\Controllers\STRIPE\PaymentController::class)->name('form.payment');
Route::post('/paymentintent',[\App\Http\Controllers\STRIPE\PaymentIntentController::class,'payment'])->name('payment');
Route::post('/orderproduct',[\App\Http\Controllers\OrderController::class,'create'])->name('order.product');

Route::get('/dashboard',[\App\Http\Controllers\OrderController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/shopping-products',[\App\Http\Controllers\ShoppingProductsController::class,'index'])->name('shopping-products');
    Route::get('/shopping-products/increase/{id}',[\App\Http\Controllers\ShoppingProductsController::class,'increase'])->name('shopping.increase');
    Route::delete('/shopping-products/destroy/{id}',[\App\Http\Controllers\ShoppingProductsController::class,'destroy'])->name('shopping.destroy');
    Route::get('/shopping-products/decrease/{id}',[\App\Http\Controllers\ShoppingProductsController::class,'decrease'])->name('shopping.decrease');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
