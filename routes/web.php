<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [MenuController::class, 'index'])->name('home');
Route::get('/menu/{id}', [MenuController::class, 'show']);

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN & REGISTER MANUAL)
|--------------------------------------------------------------------------
*/

// HALAMAN LOGIN
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 🔥 PROSES LOGIN (SUDAH SUPPORT ROLE)
Route::post('/login', function (Request $request) {

    $credentials = $request->only('email', 'password');
    $role = $request->role; // 🔥 ambil role dari form

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // 🔥 CEK ROLE
        if (Auth::user()->role != $role) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Login gagal! Role tidak sesuai.',
            ]);
        }

        // 🔥 REDIRECT SESUAI ROLE
        if ($role == 'admin') {
            return redirect('/admin');
        } else {
            return redirect()->route('welcome');
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah!',
    ]);
});

// HALAMAN REGISTER
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// PROSES REGISTER
Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:5',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'customer' // 🔥 default customer
    ]);

    Auth::login($user);

    return redirect()->route('welcome');
});

/*
|--------------------------------------------------------------------------
| HALAMAN WELCOME
|--------------------------------------------------------------------------
*/

Route::get('/welcome', function () {
    return view('auth.welcome');
})->middleware('auth')->name('welcome');

/*
|--------------------------------------------------------------------------
| ADMIN PAGE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    // Menu Management
    Route::resource('menu', \App\Http\Controllers\AdminMenuController::class)->except(['show']);

    // Topping Management
    Route::resource('topping', \App\Http\Controllers\AdminToppingController::class)->except(['show']);

    // Pesanan Management
    Route::get('pesanan', [\App\Http\Controllers\AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::get('pesanan/{id}', [\App\Http\Controllers\AdminPesananController::class, 'show'])->name('pesanan.show');
});

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [MenuController::class, 'cart'])->name('cart');
Route::post('/cart/remove/{index}', [MenuController::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/clear', [MenuController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/update/{index}', [MenuController::class, 'updateCart'])->name('cart.update');

// 🔥 Edit topping
Route::get('/cart/edit/{index}', [MenuController::class, 'editCart'])->name('cart.edit');
Route::post('/cart/edit/{index}', [MenuController::class, 'updateCartTopping'])->name('cart.edit.update');

/*
|--------------------------------------------------------------------------
| DASHBOARD
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
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');