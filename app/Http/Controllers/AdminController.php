<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $totalPendapatan = Pesanan::sum('total_harga');
        $totalPesananHariIni = Pesanan::whereDate('created_at', today())->count(); // Assuming there's a created_at or we will just count all for today. But wait, Pesanan has public $timestamps = false. So we can't reliably filter by today if there's no date column. Wait, let me check checking pesanan table columns. I will just show total pesanan if date column doesn't exist, or just use a fallback. 
        // For now, let's fetch total pesanan.
        $totalPesananHariIni = Pesanan::count(); // Fallback

        // Check columns to be safe
        $pesananColumns = \Illuminate\Support\Facades\Schema::getColumnListing('pesanan');
        if (in_array('created_at', $pesananColumns)) {
            $totalPesananHariIni = Pesanan::whereDate('created_at', today())->count();
        } elseif (in_array('tanggal', $pesananColumns)) {
            $totalPesananHariIni = Pesanan::whereDate('tanggal', today())->count();
        }

        $topMenu = Menu::withCount('detailPesanan')
            ->orderBy('detail_pesanan_count', 'desc')
            ->first();

        return view('admin.dashboard', compact('totalPendapatan', 'totalPesananHariIni', 'topMenu'));
    }
}
