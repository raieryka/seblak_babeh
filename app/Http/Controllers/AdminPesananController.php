<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class AdminPesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (Auth::user()->role != 'admin') abort(403);
        
        $query = Pesanan::orderBy('id_pesanan', 'desc');

        $pesananColumns = \Illuminate\Support\Facades\Schema::getColumnListing('pesanan');

        if ($request->filter == 'today') {
            if (in_array('created_at', $pesananColumns)) {
                $query->whereDate('created_at', today());
            } elseif (in_array('tanggal', $pesananColumns)) {
                $query->whereDate('tanggal', today());
            }
        }

        if ($request->has('search')) {
            $query->where('nama_pelanggan', 'like', '%' . $request->search . '%')
                  ->orWhere('id_pesanan', $request->search);
        }

        $pesanan = $query->get();
        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function show($id)
    {
        if (Auth::user()->role != 'admin') abort(403);
        
        $pesanan = Pesanan::with('detailPesanan.menu')->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }
}
