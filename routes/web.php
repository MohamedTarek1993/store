<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\CartPageController;

Route::get('/', [ProductPageController::class, 'index'])->name('home');
Route::get('/product-detials/{id}', [ProductPageController::class, 'show'])->name('product-detials');

// route cart 
Route::post('/add-to-cart/{id}', [AddToCartController::class, 'store'])->name('add-to-cart');
Route::get('/cart', [CartPageController::class, 'index'])->name('cart');
Route::get('/dashboard', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::resource('product', App\Http\Controllers\ProductController::class);