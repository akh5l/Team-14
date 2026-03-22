<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware('force.password')->group(function () { // ensures redirect if password should be changed
    Route::get('/', function () {
        return view('landing');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/contact-us', function () {
        return view('contact');
    });

    Route::get('/contact', function () {
        return view('contact');
    });
    Route::get('/about', function () {
        return view('about_us');
    });

    Route::get('/faq', function () {
        return view('faq');
    });

    Route::get('/admin/register', [AdminAuthController::class, 'showRegister'])->name('admin.register');
    Route::post('/admin/register', [AdminAuthController::class, 'register'])->middleware('throttle:5,1');
});

Route::middleware('auth', 'force.password')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])
        ->name('cart.add')
        ->middleware('throttle:60,1');
    Route::post('/cart/buyNow/{product}', [App\Http\Controllers\CartController::class, 'buyNow'])
        ->name('cart.buyNow')
        ->middleware('throttle:60,1');

    Route::post('/cart/remove/{productId}', [App\Http\Controllers\CartController::class, 'remove'])
        ->name('cart.remove')
        ->middleware('throttle:60,1');
    Route::post('/cart/update/{productId}', [CartController::class, 'update'])
        ->name('cart.update')
        ->middleware('throttle:60,1');

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store')
        ->middleware('throttle:5,1');

    Route::get('/orders', [OrderController::class, 'orderHistory'])->name('orders.history');

    Route::post('/reviews/{product_id}', [ReviewController::class, 'store'])
        ->name('reviews.store')
        ->middleware('throttle:3,1');

});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/password/change', [AdminPasswordController::class, 'show']);
    Route::put('/password/change', [AdminPasswordController::class, 'update'])
        ->name('admin.password.update');

});

Route::middleware(['auth', 'admin', 'force.password'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/invite', [AdminDashboardController::class, 'generateInvite'])
        ->name('admin.invite.generate')
        ->middleware('throttle:10,1');

    Route::delete('/reviews/{review_id}', [ReviewController::class, 'delete'])->name('review.delete');
    Route::post('/orders/return', [OrderController::class, 'returnItems'])->name('orders.return');
    Route::post('/admin/orders/{order}/process', [OrderController::class, 'process'])->name('orders.process');

    Route::put('/admin/customers/{user}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/admin/customers/{user}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    Route::get('/admin/inventory', fn() => view('admin.inventory'))->name('admin.inventory');
});

require __DIR__.'/auth.php';
