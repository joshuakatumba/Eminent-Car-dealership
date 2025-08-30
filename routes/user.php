<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CustomerOrderController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

Route::get('/blog-post', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog-read/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Vehicle routes
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');

Route::get('/search', [VehicleController::class, 'search'])->name('vehicles.search');

// Customer Order routes
Route::post('/customer-orders', [CustomerOrderController::class, 'store'])->name('customer-orders.store');

// AJAX routes for dynamic content
Route::get('/api/vehicles/new-arrivals', [VehicleController::class, 'newArrivals'])->name('api.vehicles.new-arrivals');
Route::get('/api/vehicles/best-sellers', [VehicleController::class, 'bestSellers'])->name('api.vehicles.best-sellers');
Route::get('/api/vehicles/trending', [VehicleController::class, 'trending'])->name('api.vehicles.trending');
Route::get('/api/vehicles/special-offers', [VehicleController::class, 'specialOffers'])->name('api.vehicles.special-offers');
Route::get('/api/vehicles/hot-deals', [VehicleController::class, 'hotDeals'])->name('api.vehicles.hot-deals');
Route::get('/api/vehicles/{id}/quick-view', [VehicleController::class, 'quickView'])->name('api.vehicles.quick-view');

// Remove authentication from account pages - make them public
Route::get('/account-dashboard', function () {
    return view('account-dashboard');
})->name('account.dashboard');

Route::get('/account-edit-profile', function () {
    return view('account-edit-profile');
});

Route::get('/account-orders', function () {
    return view('account-orders');
});

Route::get('/account-profile', function () {
    return view('account-profile');
});

Route::get('/account-saved-address', function () {
    return view('account-saved-address');
});

Route::get('/address', function () {
    return view('address');
});

Route::get('/billing-details', function () {
    return view('billing-details');
});

Route::get('/payment-method', function () {
    return view('payment-method');
});

// Remove authentication routes - users don't need to login
// Route::get('/authentication-login', function () {
//     return view('authentication-login');
// });

// Route::get('/authentication-register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
// Route::post('/authentication-register', [RegisterController::class, 'register'])->name('register.post')->middleware('guest');

// Route::get('/authentication-reset-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('/authentication-reset-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/cart', function () {
    return view('cart');
});

// New routes for product and shop pages
Route::get('/product-details', function () {
    return view('product-details');
});



Route::get('/shop-grid-type-4', function () {
    return view('shop-grid-type-4');
});

Route::get('/shop-grid-type-5', function () {
    return view('shop-grid-type-5');
});

Route::get('/shop-grid', function () {
    return view('shop-grid');
});

Route::get('/subaru-grid-type-5', function () {
    return view('subaru-grid-type-5');
});

Route::get('/thank-you', function () {
    return view('thank-you');
});

Route::get('/wishlist', function () {
    return view('wishlist');
});

// Remove all authentication routes - only admins need authentication
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
// Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
