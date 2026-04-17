@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('topping.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<h2 class="fw-bold mb-4">Tambah Topping Baru</h2>

<div class="card card-custom p-4 shadow-sm" style="max-width: 600px;">
    <form action="{{ route('topping.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Topping</label>
            <input type="text" name="nama_topping" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Harga Topping</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Stok Topping</label>
                <input type="number" name="stok" class="form-control" value="20" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Gambar Topping</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-merah w-100 fw-bold py-2 mt-3 mb-2 text-white">Simpan Topping</button>
    </form>
</div>
@endsection
