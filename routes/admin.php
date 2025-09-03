<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\CustomerOrderController;

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Auth\LoginController;

// Admin Login Routes (no middleware - anyone can access login)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout routes (no middleware - should be accessible)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');

// Redirect /admin root to vehicles if authenticated, otherwise to login
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('admin.login');
    }
    return redirect()->route('admin.vehicles.index');
})->name('root');

// Admin Routes - Protected with admin.auth and admin middleware
Route::middleware(['admin.auth', 'admin'])->group(function () {
    
    // Admin Index/Home - redirects to vehicles
    Route::get('/home', function () {
        return redirect()->route('admin.vehicles.index');
    })->name('home');
    
    // Profile and Settings
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings.index');
    Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::get('/system-info', [AdminController::class, 'systemInfo'])->name('system.info');
    Route::get('/activity-log', [AdminController::class, 'activityLog'])->name('activity.log');
    
    // Vehicles
    Route::resource('vehicles', VehicleController::class);
    Route::delete('/vehicles/{vehicle}/images/{image}', [VehicleController::class, 'deleteImage'])->name('vehicles.images.delete');
    Route::post('/vehicles/{vehicle}/images/{image}/primary', [VehicleController::class, 'setPrimaryImage'])->name('vehicles.images.primary');
    Route::post('/vehicles/{vehicle}/update-image-order', [VehicleController::class, 'updateImageOrder'])->name('vehicles.images.order');
    
    // Customers
    Route::resource('customers', CustomerController::class);
    
    // Sales
    Route::resource('sales', SalesController::class);
    
    // Customer Orders
    Route::get('/customer-orders', [CustomerOrderController::class, 'index'])->name('customer-orders.index');
    Route::get('/customer-orders/export', [CustomerOrderController::class, 'export'])->name('customer-orders.export');
    Route::put('/customer-orders/{order}/status', [CustomerOrderController::class, 'updateStatus'])->name('customer-orders.update-status');
    
    // Content
    Route::resource('content', ContentController::class);
    
    // About Us
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::put('/about-us', [AboutUsController::class, 'update'])->name('about-us.update');
    
    // Contact Messages
    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::put('/contact-messages/{contactMessage}', [ContactMessageController::class, 'update'])->name('contact-messages.update');
    Route::post('/contact-messages/{contactMessage}/replied', [ContactMessageController::class, 'markAsReplied'])->name('contact-messages.replied');
    
    // Blog Posts
    Route::resource('blog', BlogController::class);
    Route::post('/blog/{blogPost}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blog.toggle-status');

});
