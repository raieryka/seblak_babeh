<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // WAJIB LOGIN UNTUK SEMUA METHOD

        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['subtotal'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    public function proses(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/')->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['subtotal'];
        }

        // SIMPAN KE TABEL PESANAN (TAMBAH user_id)
        $pesanan = Pesanan::create([
            'user_id' => Auth::id(), // 🔥 penting banget
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'total_harga' => $total,
            'metode_bayar' => $request->metode_bayar,
            'status_pesanan' => 'diproses'
        ]);

        // SIMPAN DETAIL PESANAN
        foreach ($cart as $item) {
            DetailPesanan::create([
                'id_pesanan' => $pesanan->id,
                'id_menu' => $item['id_menu'],
                'topping' => isset($item['topping']) ? json_encode($item['topping']) : null,
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.sukses', $pesanan->id);
    }

    public function sukses($id)
    {
        $pesanan = Pesanan::with('detailPesanan.menu')
                    ->where('user_id', Auth::id()) // 🔥 biar ga bisa buka pesanan orang lain
                    ->findOrFail($id);

        return view('checkout_sukses', compact('pesanan'));
    }

    // 🔥 TAMBAHAN FITUR RIWAYAT
    public function riwayat()
    {
        $pesanans = Pesanan::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('riwayat', compact('pesanans'));
    }
}