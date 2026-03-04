<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======================
// HOME
// ======================
Route::get('/', [MenuController::class, 'index']);


// ======================
// DETAIL MENU
// ======================
Route::get('/menu/{id}', [MenuController::class, 'show']);


// ======================
// CART
// ======================
Route::post('/cart/add', [MenuController::class, 'addToCart']);
Route::get('/cart', [MenuController::class, 'cart']);


// ======================
// CHECKOUT
// ======================
Route::get('/checkout', [MenuController::class, 'checkout']);
Route::post('/checkout/process', [MenuController::class, 'processCheckout']);