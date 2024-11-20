<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;

// Product routes
Route::get('/', [ProductController::class, 'index'])->name('products');
Route::get('/add-to-cart/{product}', [ProductController::class, 'addToCart'])->name('add-cart');
Route::get('/remove-from-cart/{id}', [ProductController::class, 'removeFromCart'])->name('remove-cart');
Route::post('/change-qty/{product}', [ProductController::class, 'changeQty'])->name('change-qty');

// Cart page
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

// Payment routes
Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');
Route::post('/indipay/response/success', [PaymentController::class, 'response'])->name('pay.response');
Route::post('/indipay/response/failure', [PaymentController::class, 'response'])->name('pay.response');
Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('success.pay');
