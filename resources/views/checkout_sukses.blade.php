<!DOCTYPE html>
<html>
<head>
    <title>Struk Pesanan</title>

    <style>
        body {
            font-family: monospace;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <h3>WARUNG SEBLAK BABEH</h3>
    <hr>

    <p>Nama: {{ $pesanan->nama_pelanggan }}</p>
    <p>No HP: {{ $pesanan->no_hp }}</p>
    <p>Alamat: {{ $pesanan->alamat }}</p>
    <hr>

    <table width="100%">
        <tr>
            <th align="left">Menu</th>
            <th align="center">Qty</th>
            <th align="right">Subtotal</th>
        </tr>

        @foreach($pesanan->detailPesanan as $detail)
        <tr>
            <td>{{ $detail->menu->nama_menu }}</td>
            <td align="center">{{ $detail->jumlah }}</td>
            <td align="right">Rp {{ number_format($detail->subtotal) }}</td>
        </tr>
        @endforeach
    </table>

    <hr>
    <h4>Total: Rp {{ number_format($pesanan->total_harga) }}</h4>

    <p>Metode Bayar: {{ $pesanan->metode_bayar }}</p>
    <p>Status: {{ $pesanan->status_pesanan }}</p>

    <br>
    <p>Terima kasih sudah pesan ❤️</p>

    <button onclick="window.print()">Print Lagi</button>

</body>
</html>