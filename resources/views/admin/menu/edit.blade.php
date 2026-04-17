@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('menu.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<h2 class="fw-bold mb-4">Edit Menu</h2>

<div class="card card-custom p-4 shadow-sm" style="max-width: 800px;">
    <form action="{{ route('menu.update', $menu->id_menu) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 text-center">
            <img src="{{ asset('images/'.$menu->gambar) }}" class="rounded shadow-sm" style="height: 150px; object-fit: cover;">
            <p class="text-muted mt-2">Gambar Saat Ini</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" value="{{ $menu->nama_menu }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Harga Dasar</label>
                <input type="number" name="harga_dasar" class="form-control" value="{{ $menu->harga_dasar }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $menu->stok }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ $menu->deskripsi }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Ganti Gambar <small>(Opsional)</small></label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select" required>
                    <option value="tersedia" {{ $menu->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak_tersedia" {{ $menu->status == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">Custom Topping?</label>
                <select name="is_custom" class="form-select" required>
                    <option value="0" {{ $menu->is_custom == 0 ? 'selected' : '' }}>Tidak</option>
                    <option value="1" {{ $menu->is_custom == 1 ? 'selected' : '' }}>Ya</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-warning w-100 fw-bold py-2 mt-3">Update Menu</button>
    </form>
</div>
@endsection
