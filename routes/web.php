<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin', function () {
        return "Admin Dashboard";
    });
});

// Category CRUD Routes
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

Route::resource('customers', CustomerController::class)
    ->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::resource('orders', OrderController::class);

    // Record payment for order
    Route::post('/orders/{order}/pay', 
        [PaymentController::class, 'store']
    )->name('orders.pay');

});

// Route to open dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('suppliers', SupplierController::class);