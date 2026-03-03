<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #5a0000;
        }
        .navbar {
            background-color: #3d0000;
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body class="text-white">

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand fw-bold">
        🛒 Keranjang
    </span>
    <a href="/" class="btn btn-light">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</nav>

<div class="container mt-4">

    {{-- CART KOSONG --}}
    @if(empty($cart))
        <div class="alert alert-light text-dark">
            Keranjang masih kosong.
        </div>
    @else

        {{-- LIST ITEM --}}
        @foreach($cart as $index => $item)
        <div class="card mb-3">
            <div class="card-body text-dark">

                {{-- Nama Menu --}}
                <h5 class="fw-bold">{{ $item['nama_menu'] }}</h5>

                {{-- Harga dasar --}}
                <p>
                    Harga Dasar :
                    Rp {{ number_format($item['harga_dasar']) }}
                </p>

                {{-- TOPPING --}}
                @if(count($item['topping']) > 0)
                    <p class="mb-1">Topping:</p>
                    <ul>
                        @foreach ($item['topping'] as $t)
                            <li>
                                {{ $t->nama_topping }}
                                (Rp {{ number_format($t->harga_topping) }})
                            </li>
                        @endforeach
                    </ul>
                @endif

                {{-- SUBTOTAL --}}
                <p class="fw-bold text-danger">
                    Subtotal: Rp {{ number_format($item['subtotal']) }}
                </p>

                {{-- HAPUS ITEM --}}
                <form action="/cart/remove/{{ $index }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>

            </div>
        </div>
        @endforeach

        {{-- TOTAL --}}
        <div class="card bg-danger text-white p-3">
            <h4>Total: Rp {{ number_format($total) }}</h4>
        </div>

        {{-- CHECKOUT --}}
        <a href="/checkout" class="btn btn-light w-100 mt-3">
            Lanjut Checkout
        </a>

        {{-- CLEAR CART --}}
        <form action="/cart/clear" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-outline-light w-100">
                Kosongkan Keranjang
            </button>
        </form>

    @endif

</div>

</body>
</html>1