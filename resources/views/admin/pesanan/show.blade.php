@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="row">
    <!-- INFO PELANGGAN -->
    <div class="col-md-4 mb-4">
        <div class="card card-custom shadow-sm p-4 h-100">
            <h4 class="fw-bold mb-4 text-babeh">Detail Pelanggan</h4>
            <p class="mb-2"><i class="fas fa-user me-2"></i> <strong>Nama:</strong><br>{{ $pesanan->nama_pelanggan }}</p>
            <p class="mb-2"><i class="fas fa-phone me-2"></i> <strong>No HP:</strong><br>{{ $pesanan->no_hp }}</p>
            <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> <strong>Alamat:</strong><br>{{ $pesanan->alamat ?? '-' }}</p>
            <hr>
            <p class="mb-2"><i class="fas fa-money-bill-wave me-2"></i> <strong>Metode Bayar:</strong> <span class="badge bg-secondary">{{ strtoupper($pesanan->metode_bayar) }}</span></p>
            <p class="mb-2"><i class="fas fa-info-circle me-2"></i> <strong>Status:</strong> 
                @if($pesanan->status_pesanan == 'diproses')
                    <span class="badge bg-warning text-dark">Diproses</span>
                @else
                    <span class="badge bg-success">{{ ucfirst($pesanan->status_pesanan) }}</span>
                @endif
            </p>
        </div>
    </div>

    <!-- DAFTAR ITEM PESANAN -->
    <div class="col-md-8 mb-4">
        <div class="card card-custom shadow-sm p-4 h-100">
            <h4 class="fw-bold mb-4 text-babeh">Daftar Menu yang Dipesan (#{{ $pesanan->id_pesanan }})</h4>
            
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Menu</th>
                            <th>Topping</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->detailPesanan as $detail)
                        <tr>
                            <td class="fw-bold text-dark">
                                {{ $detail->menu->nama_menu ?? 'Menu Dihapus' }}
                            </td>
                            <td>
                                @php
                                    $toppings = json_decode($detail->topping, true);
                                @endphp
                                @if(!empty($toppings))
                                    <ul class="mb-0 ps-3 text-muted">
                                        @foreach($toppings as $top)
                                            <li>{{ $top['nama_topping'] }} <small>(+Rp {{ number_format($top['harga'] ?? $top['harga_topping']) }})</small></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted"><small>Tanpa Topping</small></span>
                                @endif
                            </td>
                            <td class="text-center fw-bold">{{ $detail->jumlah }}</td>
                            <td class="text-end text-danger fw-bold">Rp {{ number_format($detail->subtotal) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-dark">
                        <tr>
                            <td colspan="3" class="text-end fw-bold">TOTAL HARGA:</td>
                            <td class="text-end fw-bold">Rp {{ number_format($pesanan->total_harga) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
