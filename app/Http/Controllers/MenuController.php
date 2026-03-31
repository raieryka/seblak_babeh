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

        $toppings = Topping::whereIn(
            'id_topping',
            $request->topping ?? []
        )->get();

        $cart = session()->get('cart', []);

        $hargaDasar = $menu->is_custom ? 0 : $menu->harga_dasar;
        $totalTopping = $toppings->sum('harga_topping');

        $jumlah = 1;

        $subtotal = ($hargaDasar + $totalTopping) * $jumlah;

        $cart[] = [
            'id_menu' => $menu->id_menu,
            'nama_menu' => $menu->nama_menu,
            'harga_dasar' => $menu->harga_dasar,
            'topping' => $toppings->toArray(),
            'jumlah' => $jumlah,
            'subtotal' => $subtotal
        ];

        session()->put('cart', $cart);

        return redirect('/cart');
    }

    // ======================
    // EDIT CART (PILIH TOPPING)
    // ======================
    public function editCart($index)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$index])) {
            return redirect()->back();
        }

        $item = $cart[$index];
        $menu = Menu::findOrFail($item['id_menu']);
        $topping = Topping::all();

        return view('cart_edit', compact('item', 'index', 'menu', 'topping'));
    }

    public function updateCartTopping(Request $request, $index)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$index])) {
            return redirect()->back();
        }

        $menu = Menu::findOrFail($cart[$index]['id_menu']);
        $toppings = Topping::whereIn('id_topping', $request->topping ?? [])->get();

        $hargaDasar = $menu->is_custom ? 0 : $menu->harga_dasar;
        $totalTopping = $toppings->sum('harga_topping');
        $jumlah = $cart[$index]['jumlah'];

        $cart[$index]['topping'] = $toppings->toArray();
        $cart[$index]['subtotal'] = ($hargaDasar + $totalTopping) * $jumlah;

        session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    // ======================
    // UPDATE JUMLAH (+ / -)
    // ======================
    public function updateCart(Request $request, $index)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$index])) {
            return redirect()->back();
        }

        $jumlahBaru = max(1, $request->jumlah);

        $menu = Menu::find($cart[$index]['id_menu']);
        $hargaDasar = $menu->is_custom ? 0 : $cart[$index]['harga_dasar'];

        $totalTopping = 0;
        if (!empty($cart[$index]['topping'])) {
            $totalTopping = collect($cart[$index]['topping'])->sum('harga_topping');
        }

        $cart[$index]['jumlah'] = $jumlahBaru;
        $cart[$index]['subtotal'] = ($hargaDasar + $totalTopping) * $jumlahBaru;

        session()->put('cart', $cart);

        return redirect()->back();
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

        $cart = array_values($cart);
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