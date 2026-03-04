@extends('layouts.app')

@section('content')

<div class="text-center mb-5">
    <h1 class="fw-bold text-white">Seblak Prasmanan Babeh</h1>
    <p class="text-white">Pilih menu favorit kamu sekarang juga!</p>
</div>

<div class="row">
    @foreach($menu as $m)
    <div class="col-md-4 mb-4">
        <div class="card shadow">

            <!-- Gambar -->
            <img src="{{ asset('images/' . $m->gambar) }}" 
                 style="height:220px; object-fit:cover;">

            <div class="card-body text-dark">

                <h5 class="card-title fw-bold">
                    {{ $m->nama_menu }}
                </h5>

                <p class="text-danger fw-bold">
                    Rp {{ number_format($m->harga_dasar) }}
                </p>

                <a href="{{ url('/menu/' . $m->id_menu) }}" 
                   class="btn btn-merah w-100">
                    <i class="bi bi-eye-fill"></i> Tambah Keranjang
                </a>

            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection