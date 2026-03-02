<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);
Route::post('/cart/add', [MenuController::class, 'addToCart']);
Route::get('/cart', [MenuController::class, 'cart']);

Route::get('/checkout', [MenuController::class, 'checkout']);
Route::post('/checkout/process', [MenuController::class, 'processCheckout']);