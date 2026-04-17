@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Manajemen Menu</h2>
    <a href="{{ route('menu.create') }}" class="btn btn-merah fw-bold"><i class="fas fa-plus"></i> Tambah Menu Baru</a>
</div>

<div class="card card-custom p-4">
    <form method="GET" action="{{ route('menu.index') }}" class="mb-4 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari nama menu..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-dark">Cari</button>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Harga Dasar</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                <tr>
                    <td>
                        <img src="{{ asset('images/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="rounded shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                    </td>
                    <td class="fw-bold">{{ $menu->nama_menu }}
                        @if($menu->is_custom)
                            <br><small class="text-danger">Custom Topping</small>
                        @endif
                    </td>
                    <td>Rp {{ number_format($menu->harga_dasar) }}</td>
                    <td>
                        @if($menu->stok <= 0)
                            <span class="badge bg-danger">Habis</span>
                        @else
                            <span class="badge bg-success">{{ $menu->stok }}</span>
                        @endif
                    </td>
                    <td>
                        @if($menu->status == 'tersedia')
                            <span class="badge bg-primary">Tersedia</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($menu->status) }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('menu.edit', $menu->id_menu) }}" class="btn btn-sm btn-warning mb-1"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('menu.destroy', $menu->id_menu) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Hapus menu ini?')"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada menu ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
