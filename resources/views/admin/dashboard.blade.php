@extends('admin.layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Dashboard Utama</h2>

<div class="row text-white text-center">
    
    <div class="col-md-4 mb-4">
        <div class="card card-custom bg-danger h-100">
            <div class="card-body py-5">
                <i class="fas fa-shopping-cart fa-3x mb-3 text-warning"></i>
                <h4 class="card-title">Total Pesanan</h4>
                <h1 class="fw-bold display-4">{{ $totalPesananHariIni }}</h1>
                <p class="m-0">Semua Waktu/Hari Ini</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card card-custom" style="background:#5a0000;">
            <div class="card-body py-5">
                <i class="fas fa-wallet fa-3x mb-3 text-warning"></i>
                <h4 class="card-title">Total Pendapatan</h4>
                <h2 class="fw-bold mt-3">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card card-custom bg-warning text-dark h-100">
            <div class="card-body py-5">
                <i class="fas fa-crown fa-3x mb-3 text-danger"></i>
                <h4 class="card-title">Menu Paling Laris</h4>
                @if($topMenu)
                    <h3 class="fw-bold mt-2">{{ $topMenu->nama_menu }}</h3>
                    <p class="m-0 fw-bold text-danger">{{ $topMenu->detail_pesanan_count }} x Dipesan</p>
                @else
                    <h3 class="fw-bold mt-2">Belum ada</h3>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
