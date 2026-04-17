<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum('subtotal'); // total sekarang sesuai topping

        return view('checkout', compact('cart', 'total'));
    }

    public function proses(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/')->with('error', 'Keranjang kosong!');
        }

        $total = collect($cart)->sum('subtotal');

        // ==========================
        // CEK STOK DULU
        // ==========================
        foreach ($cart as $item) {

            $menu = Menu::find($item['id_menu']);

            if (!$menu) {
                return redirect()->back()->with('error', 'Menu tidak ditemukan!');
            }

            if ($menu->stok < $item['jumlah']) {
                return redirect()->back()->with(
                    'error',
                    'Stok ' . $menu->nama_menu . ' tidak cukup!'
                );
            }

            // CEK STOK TOPPING
            if (isset($item['topping']) && is_array($item['topping'])) {
                foreach ($item['topping'] as $top) {
                    $toppingModel = \App\Models\Topping::find($top['id_topping']);
                    if ($toppingModel && $toppingModel->stok < $item['jumlah']) {
                        return redirect()->back()->with(
                            'error',
                            'Stok topping ' . $toppingModel->nama_topping . ' tidak cukup!'
                        );
                    }
                }
            }
        }

        // ==========================
        // SIMPAN PESANAN
        // ==========================
        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'total_harga' => $total,
            'metode_bayar' => $request->metode_bayar,
            'status_pesanan' => 'diproses',
        ]);

        // ==========================
        // SIMPAN DETAIL + KURANGI STOK
        // ==========================
        foreach ($cart as $item) {

            DetailPesanan::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_menu' => $item['id_menu'],
                'topping' => isset($item['topping']) ? json_encode($item['topping']) : null,
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal'], // 🔥 subtotal sesuai topping
            ]);

            // 🔥 KURANGI STOK
            $menu = Menu::find($item['id_menu']);

            if ($menu) {
                $menu->stok = $menu->stok - $item['jumlah'];
                $menu->save();
            }

            // 🔥 KURANGI STOK TOPPING
            if (isset($item['topping']) && is_array($item['topping'])) {
                foreach ($item['topping'] as $top) {
                    $toppingModel = \App\Models\Topping::find($top['id_topping']);
                    if ($toppingModel) {
                        $toppingModel->stok = $toppingModel->stok - $item['jumlah'];
                        $toppingModel->save();
                    }
                }
            }
        }

        // HAPUS CART
        session()->forget('cart');

        return redirect()->route('checkout.sukses', [
            'id' => $pesanan->id_pesanan
        ]);
    }

    public function sukses($id)
    {
        $pesanan = Pesanan::with('detailPesanan.menu')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('checkout_sukses', compact('pesanan'));
    }

    public function riwayat()
    {
        $pesanans = Pesanan::where('user_id', Auth::id())
                    ->orderBy('id_pesanan', 'desc') // pesanan terbaru muncul dulu
                    ->get();

        return view('riwayat', compact('pesanans'));
    }
}