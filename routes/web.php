<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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

// Authentication routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

//Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Registration route
Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

// Admin dashboard
Route::middleware('auth')->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});