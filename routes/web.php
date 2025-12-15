<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Home route
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication routes (Login & Register)
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('products', ProductController::class);

// Protected routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

});