<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class CheckoutController extends Controller
{
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

        if(empty($cart)){
            return redirect('/')->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['subtotal'];
        }

        // SIMPAN KE TABEL PESANAN
        $pesanan = Pesanan::create([
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
                'id_pesanan' => $pesanan->id_pesanan,
                'id_menu' => $item['id_menu'],
                'topping' => $item['topping'] ?? null,
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        session()->forget('cart');

        // REDIRECT KE HALAMAN SUKSES
        return redirect()->route('checkout.sukses', $pesanan->id_pesanan);
    }

    public function sukses($id)
    {
        $pesanan = Pesanan::with('detailPesanan.menu')
                    ->findOrFail($id);

        return view('checkout_sukses', compact('pesanan'));
    }
}