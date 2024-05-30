<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\SocialController;
use App\Http\Controllers\Frontend\Auth\RegisterController;

Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');
Route::get('/category/{slug}', [ProductController::class, 'showCategoryProduct'])->name('product.category');
Route::get('/product/{slug}', [ProductController::class, 'showProduct'])->name('product.show');

// *Search
Route::get('/products/search', [ProductController::class, 'searchProduct'])->name('product.search');

// *Sign-in
Route::get('/sign-in',[LoginController::class, 'showLoginForm'])->name('signin');
Route::post('/sign-in',[LoginController::class, 'login'])->name('signin.verify');
// *Sign-up
Route::get('/sign-up',[RegisterController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup-store',[RegisterController::class, 'register'])->name('signup.store');
// *Sign-out
Route::get('/sign-out',[LoginController::class, 'logout'])->name('signout');
// *Google
Route::get('/google/login',[SocialController::class, 'googleLogin'])->name('google.login');
Route::get('/google/redirect',[SocialController::class, 'googleVerify'])->name('google.verify');
// *Profilre
Route::get('/my-profile', function(){
    return view('frontend.MyAccount');
})->middleware('customer');

// *Cart Update
Route::middleware('customer')->name('cart.')->prefix('/cart/')->controller(CartController::class)->group(function(){
    Route::post('/cart-store', 'storeCart')->name('store');
    Route::put('/cart-update', 'updateCart')->name('update');
    Route::get('/view-cart', 'viewCart')->name('view');
    Route::get('/cart-delete/{id}', 'deleteCart')->name('delete');
});

// *Cart Checkout
Route::middleware('customer')->name('order.')->prefix('/order/')->controller(OrderController::class)->group(function(){
    Route::get('/checkout', 'checkout')->name('checkout');
});