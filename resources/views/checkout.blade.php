<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Seblak Babeh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <h2 class="mb-4">🛒 Checkout</h2>

    <div class="card bg-danger text-white mb-4">
        <div class="card-body">
            <h5>Ringkasan Pesanan</h5>
            <hr>

            @forelse($cart as $item)
                <p>
                    <strong>{{ $item['nama_menu'] ?? '' }}</strong><br>

                    {{-- TAMPILKAN TOPPING --}}
                    @if(!empty($item['topping']))
                        Topping:
                        {{ collect($item['topping'])->pluck('nama_topping')->implode(', ') }}
                        <br>
                    @endif

                    Jumlah: {{ $item['jumlah'] ?? 1 }}<br>
                    Subtotal: Rp {{ number_format($item['subtotal'] ?? 0) }}
                </p>
                <hr>
            @empty
                <p>Keranjang kosong.</p>
            @endforelse

            <h4>Total: Rp {{ number_format($total ?? 0) }}</h4>
        </div>
    </div>

    <form action="{{ route('checkout.proses') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="metode_bayar" class="form-control" required>
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning w-100">
            💳 Konfirmasi Pesanan
        </button>

    </form>

</div>

</body>
</html>