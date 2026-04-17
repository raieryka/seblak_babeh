@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('topping.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<h2 class="fw-bold mb-4">Edit Topping</h2>

<div class="card card-custom p-4 shadow-sm" style="max-width: 600px;">
    <form action="{{ route('topping.update', $topping->id_topping) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 text-center">
            <img src="{{ asset('images/'.$topping->gambar) }}" class="rounded shadow-sm" style="height: 150px; object-fit: cover;">
            <p class="text-muted mt-2">Gambar Saat Ini</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Topping</label>
            <input type="text" name="nama_topping" class="form-control" value="{{ $topping->nama_topping }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Harga Topping</label>
                <input type="number" name="harga" class="form-control" value="{{ $topping->harga }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Stok Topping</label>
                <input type="number" name="stok" class="form-control" value="{{ $topping->stok }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Ganti Gambar <small class="text-muted">(Opsional)</small></label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-warning w-100 fw-bold py-2 mt-3 mb-2">Update Topping</button>
    </form>
</div>
@endsection
