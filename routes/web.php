<?php

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
Route::get('/products', [ProductController::class, 'index'])->name('products'); // Product listing page
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show'); // Product detail page
Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add-to-cart'); // Add to cart from product page
Route::get('/remove-from-cart/{id}', [CartController::class, 'remove'])->name('cart.remove'); // Remove item from cart
Route::post('/change-qty/{product}', [ProductController::class, 'changeQty'])->name('change-qty'); // Change quantity of product in cart

// Cart Routes
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show'); // View cart page
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update'); // Update cart items

// Payment Routes
Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout'); // Checkout page
Route::get('/payment', [PaymentController::class, 'index'])->name('payment'); // Payment page
Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');
Route::post('/indipay/response/success', [PaymentController::class, 'response'])->name('pay.response');
Route::post('/indipay/response/failure', [PaymentController::class, 'response'])->name('pay.response');

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
});

// About Page Route
Route::get('/about', function () {
    return view('about.index');
})->name('about');

// Show the contact form
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');

// Handle form submission
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// Cart page
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');


Route::get('/add-to-cart/{product}', [ProductController::class, 'addToCart'])->name('add-cart');
Route::get('/remove-from-cart/{id}', [ProductController::class, 'removeFromCart'])->name('remove-cart');
Route::post('/change-qty/{product}', [ProductController::class, 'changeQty'])->name('change-qty');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');

Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');

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
// Remove this group
Route::get('/checkout', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('checkout');

Route::middleware(['auth'])->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index'); // Order Summary Page
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place'); // Place Order
});
// Route::get('/order', [OrderController::class, 'index'])->name('order.index');

// // Place Order
// Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });
    Route::middleware('auth')->group(function () {
        Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
    });
    // Route to remove an item from the cart
    Route::get('/admin/products', [AdminController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
    
    
    Route::get('/search', [ProductController::class, 'search'])->name('search');