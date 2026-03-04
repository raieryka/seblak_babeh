<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (BISA DIAKSES TANPA LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/', [MenuController::class, 'index'])->name('home');
Route::get('/menu/{id}', [MenuController::class, 'show']);

Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [MenuController::class, 'cart'])->name('cart');
Route::post('/cart/remove/{index}', [MenuController::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/clear', [MenuController::class, 'clearCart'])->name('cart.clear');

/*
|--------------------------------------------------------------------------
| DASHBOARD (UNTUK REDIRECT SETELAH LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [MenuController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| WAJIB LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/proses', [CheckoutController::class, 'proses'])->name('checkout.proses');
    Route::get('/checkout/sukses/{id}', [CheckoutController::class, 'sukses'])->name('checkout.sukses');
    Route::get('/riwayat', [CheckoutController::class, 'riwayat'])->name('riwayat');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (DARI BREEZE)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');