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
    // TAMBAH KE CART (SESSION)
    // ======================
    public function addToCart(Request $request)
    {
        $menu = Menu::findOrFail($request->id_menu);
        $toppings = Topping::whereIn('id_topping', $request->topping ?? [])->get();

        $cart = session()->get('cart', []);

        $totalTopping = $toppings->sum('harga_topping');
        $subtotal = $menu->harga_dasar + $totalTopping;

        $cart[] = [
            'id_menu' => $menu->id_menu,
            'nama_menu' => $menu->nama_menu,
            'harga_dasar' => $menu->harga_dasar,
            'topping' => $toppings,
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
    // CHECKOUT PAGE
    // ======================
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum('subtotal');

        return view('checkout', compact('cart', 'total'));
    }

    // ======================
    // PROSES CHECKOUT
    // ======================
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if(empty($cart)){
            return redirect('/');
        }

        $total = collect($cart)->sum('subtotal');

        $pesanan = Pesanan::create([
            'nama_pembeli' => $request->nama_pembeli,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'tipe_pengambilan' => $request->tipe_pengambilan,
            'jam_ambil' => $request->jam_ambil,
            'total_harga' => $total
        ]);

        foreach($cart as $item){
            DetailPesanan::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_menu' => $item['id_menu'],
                'subtotal' => $item['subtotal']
            ]);
        }

        session()->forget('cart');

        return redirect('/')->with('success', 'Pesanan berhasil dibuat!');
    }
}