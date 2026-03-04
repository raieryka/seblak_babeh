<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CheckoutController;

// halaman menu
Route::get('/', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);

// ================== CART ==================
Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [MenuController::class, 'cart'])->name('cart');
Route::post('/cart/remove/{index}', [MenuController::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/clear', [MenuController::class, 'clearCart'])->name('cart.clear');

// ================== CHECKOUT ==================
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/proses', [CheckoutController::class, 'proses'])->name('checkout.proses');

Route::get('/checkout/sukses/{id}', [CheckoutController::class, 'sukses'])->name('checkout.sukses');