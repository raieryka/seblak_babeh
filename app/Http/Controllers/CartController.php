<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Tambah menu ke cart
    public function add(Request $request)
    {
        $menu = Menu::find($request->id_menu);

        if (!$menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan!');
        }

        $jumlah = $request->jumlah ?? 1; // default 1 porsi
        $topping = $request->topping ?? []; // array id topping

        // Hitung subtotal
        $subtotal = $menu->harga_dasar;

        if ($menu->is_custom && !empty($topping)) {
            foreach ($topping as $idTopping) {
                $toppingMenu = $menu->toppings()->find($idTopping);
                if ($toppingMenu) {
                    $subtotal += $toppingMenu->harga_topping;
                }
            }
        }

        $subtotal = $subtotal * $jumlah;

        // Ambil cart dari session
        $cart = session()->get('cart', []);

        // Buat key unik untuk menu + topping
        $key = $menu->id_menu . '-' . implode(',', $topping);

        if (isset($cart[$key])) {
            // Kalau sudah ada, jumlah ditambah
            $cart[$key]['jumlah'] += $jumlah;
            $cart[$key]['subtotal'] += $subtotal;
        } else {
            // Kalau belum ada, tambah baru
            $cart[$key] = [
                'id_menu' => $menu->id_menu,
                'nama_menu' => $menu->nama_menu,
                'harga_dasar' => $menu->harga_dasar,
                'topping' => $topping,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $menu->nama_menu . ' berhasil ditambahkan ke keranjang!');
    }

    // Hapus item dari cart
    public function remove($key)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$key])){
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    // Lihat cart
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum('subtotal');

        return view('cart', compact('cart', 'total'));
    }
}