<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;

// Home Route (Homepage)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // Product listing page
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show'); // Product detail page
Route::get('/search', [ProductController::class, 'search'])->name('products.search'); // Search products

// Cart Routes
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show'); // View cart page
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update'); // Update cart items
Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add-to-cart'); // Add to cart from product page
Route::get('/remove-from-cart/{id}', [CartController::class, 'remove'])->name('cart.remove'); // Remove item from cart
Route::post('/change-qty/{product}', [ProductController::class, 'changeQty'])->name('change-qty'); // Change quantity of product in cart

// Payment Routes
Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout'); // Checkout page
Route::get('/payment', [PaymentController::class, 'index'])->name('payment'); // Payment page
Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');
Route::post('/indipay/response/success', [PaymentController::class, 'response'])->name('pay.response');
Route::post('/indipay/response/failure', [PaymentController::class, 'response'])->name('pay.response');
Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('success.pay');

// Authentication Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Registration route
Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

// Profile Routes (for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin Routes (Authenticated Routes)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/products', [AdminController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
});

// Contact Routes
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// Order Routes (for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index'); // Order Summary Page
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place'); // Place Order
});

// Admin Dashboard and Product Management
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Search Route for Products
Route::get('/search', [ProductController::class, 'search'])->name('products.search'); // Search for products

// Duplicate routes removed, kept the necessary ones

Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show'); // View cart page
// Cart Routes (in web.php)


Route::middleware('auth')->group(function() {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/update/{id}', [CartController::class, 'updateCartQuantity'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});
// Cart-related routes
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('add-cart');
// About Route
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart'); // This should be your 'cart' route
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('add-cart'); // Add to cart from product page
Route::post('/cart/update/{id}', [CartController::class, 'updateCartQuantity'])->name('cart.update'); // Update cart items
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove'); // Remove item from cart

