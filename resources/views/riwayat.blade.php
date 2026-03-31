@extends('layouts.app')

@section('content')

<h3 class="text-white mb-4">Riwayat Pesanan</h3>

@if($pesanans->isEmpty())
    <div class="alert alert-light">
        Belum ada pesanan.
    </div>
@else

    @foreach($pesanans as $p)
        <div class="card mb-3 p-3">

            <h5 class="fw-bold">
                Pesanan #{{ $p->id_pesanan }}
            </h5>

            <p class="mb-1">
                Nama: {{ $p->nama_pelanggan }}
            </p>

            <p class="mb-1">
                Total: Rp {{ number_format($p->total_harga) }}
            </p>

            <p class="mb-1">
                Status: {{ $p->status_pesanan }}
            </p>

            <a href="{{ route('checkout.sukses', $p->id_pesanan) }}"
               class="btn btn-sm btn-merah mt-2">
                Lihat Detail
            </a>

        </div>
    @endforeach

@endif

@endsection