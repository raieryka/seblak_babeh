<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Topping;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class MenuController extends Controller
{
    // ======================
    // HOME
    // ======================
    public function index()
    {
        $menu = Menu::all();
        return view('home', compact('menu'));
    }

    // ======================
    // DETAIL MENU
    // ======================
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        $topping = Topping::all();

        return view('detail', compact('menu', 'topping'));
    }

    // ======================
    // TAMBAH KE CART
    // ======================
    public function addToCart(Request $request)
    {
        $menu = Menu::findOrFail($request->id_menu);

        // ambil topping yang dipilih
        $toppings = Topping::whereIn('id_topping', $request->topping ?? [])->get();

        $cart = session()->get('cart', []);

        $totalTopping = $toppings->sum('harga_topping');
        $subtotal = $menu->harga_dasar + $totalTopping;

        $cart[] = [
            'id_menu' => $menu->id_menu,
            'nama_menu' => $menu->nama_menu,
            'harga_dasar' => $menu->harga_dasar,
            'topping' => $toppings->toArray(), // 🔥 penting
            'jumlah' => 1,
            'subtotal' => $subtotal
        ];

        session()->put('cart', $cart);

        return redirect('/cart');
    }

    // ======================
    // HALAMAN CART
    // ======================
    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum('subtotal');

        return view('cart', compact('cart', 'total'));
    }

    // ======================
    // HAPUS ITEM CART
    // ======================
    public function removeCart($index)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
        }

        $cart = array_values($cart); // rapikan index
        session()->put('cart', $cart);

        return redirect()->back();
    }

    // ======================
    // CLEAR CART
    // ======================
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }
}