<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;


// halaman menu
Route::get('/', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);


// cart
Route::post('/cart/add', [MenuController::class, 'addToCart']);
Route::get('/cart', [MenuController::class, 'cart']);
Route::post('/cart/remove/{index}', [MenuController::class, 'removeFromCart']);
Route::post('/cart/clear', [MenuController::class, 'clearCart']);

// ✅ remove item cart
Route::post('/cart/remove/{index}', [MenuController::class, 'removeCart']);

// ✅ kosongkan cart
Route::post('/cart/clear', [MenuController::class, 'clearCart']);


// checkout
Route::get('/checkout', [MenuController::class, 'checkout']);
Route::post('/checkout/process', [MenuController::class, 'processCheckout']);