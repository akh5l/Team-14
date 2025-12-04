<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/contact-us', function() {
    return view('contact');
});

Route::get('/cart', function () {
    return view('cart');
})->name('cart');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');


Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('profile.about_us');
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
});

require __DIR__.'/auth.php';
