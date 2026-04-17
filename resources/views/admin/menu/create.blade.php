@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('menu.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<h2 class="fw-bold mb-4">Tambah Menu Baru</h2>

<div class="card card-custom p-4 shadow-sm" style="max-width: 800px;">
    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_penjual" value="{{ $penjual->id_penjual }}">

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Harga Dasar</label>
                <input type="number" name="harga_dasar" class="form-control" value="0" required>
                <small class="text-muted">Isi 0 jika ini menu custom (harga ikut topping)</small>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Stok</label>
                <input type="number" name="stok" class="form-control" value="10" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Gambar Menu</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select" required>
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak_tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">Custom Topping?</label>
                <select name="is_custom" class="form-select" required>
                    <option value="0">Tidak</option>
                    <option value="1">Ya</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-merah w-100 fw-bold py-2 mt-3 text-white">Simpan Menu</button>
    </form>
</div>
@endsection
