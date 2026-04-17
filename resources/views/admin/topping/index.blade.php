@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Manajemen Topping</h2>
    <a href="{{ route('topping.create') }}" class="btn btn-merah fw-bold"><i class="fas fa-plus"></i> Tambah Topping Baru</a>
</div>

<div class="card card-custom p-4 shadow-sm">
    <form method="GET" action="{{ route('topping.index') }}" class="mb-4 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari nama topping..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-dark">Cari</button>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Gambar</th>
                    <th>Nama Topping</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($toppings as $topping)
                <tr>
                    <td>
                        <img src="{{ asset('images/' . $topping->gambar) }}" alt="{{ $topping->nama_topping }}" class="rounded shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                    </td>
                    <td class="fw-bold">{{ $topping->nama_topping }}</td>
                    <td>Rp {{ number_format($topping->harga) }}</td>
                    <td>
                        @if($topping->stok <= 0)
                            <span class="badge bg-danger">Habis</span>
                        @else
                            <span class="badge bg-success">{{ $topping->stok }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('topping.edit', $topping->id_topping) }}" class="btn btn-sm btn-warning mb-1"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('topping.destroy', $topping->id_topping) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Hapus topping ini?')"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada topping ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
