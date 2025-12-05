<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/contact-us', function () {
    return view('contact');
});

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about_us');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/buyNow/{product}', [App\Http\Controllers\CartController::class, 'buyNow'])->name('cart.buyNow');
    
    Route::post('/cart/remove/{productId}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
});

require __DIR__ . '/auth.php';
