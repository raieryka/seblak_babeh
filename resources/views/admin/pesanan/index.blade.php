@extends('admin.layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Manajemen Pesanan</h2>

<div class="card card-custom p-4 shadow-sm">
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('pesanan.index') }}" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Nama / ID Pesanan..." value="{{ request('search') }}">
                <input type="hidden" name="filter" value="{{ request('filter') }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('pesanan.index') }}" class="btn {{ request('filter') != 'today' ? 'btn-merah' : 'btn-outline-danger' }} fw-bold">Semua</a>
            <a href="{{ route('pesanan.index', ['filter' => 'today', 'search' => request('search')]) }}" class="btn {{ request('filter') == 'today' ? 'btn-merah' : 'btn-outline-danger' }} fw-bold">Pesanan Hari Ini</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Total Harga</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanan as $p)
                <tr>
                    <td class="fw-bold">#{{ $p->id_pesanan }}</td>
                    <td class="text-start">{{ $p->nama_pelanggan }}</td>
                    <td class="fw-bold text-danger">Rp {{ number_format($p->total_harga) }}</td>
                    <td><span class="badge bg-secondary">{{ strtoupper($p->metode_bayar) }}</span></td>
                    <td>
                        @if($p->status_pesanan == 'diproses')
                            <span class="badge bg-warning text-dark">Diproses</span>
                        @elseif($p->status_pesanan == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($p->status_pesanan) }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('pesanan.show', $p->id_pesanan) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i> Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted py-4">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
