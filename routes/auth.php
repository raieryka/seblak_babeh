<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (PAKAI BLADE, NO LIVEWIRE)
|--------------------------------------------------------------------------
*/

// ======================
// LOGIN
// ======================
Route::middleware('guest')->group(function () {

    // FORM LOGIN
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // PROSES LOGIN (WAJIB ADA)
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // ======================
    // REGISTER
    // ======================
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);
});


// ======================
// LOGOUT + PROTEKSI
// ======================
Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // VERIFIKASI EMAIL (BIAR GA ERROR)
    Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});