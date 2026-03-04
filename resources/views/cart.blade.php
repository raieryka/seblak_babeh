@extends('layouts.app')

@section('content')

<nav class="navbar navbar-dark px-4 mb-3" style="background-color:#3d0000;">
    <span class="navbar-brand fw-bold text-white">
        🛒 Keranjang
    </span>
    <a href="{{ route('home') }}" class="btn btn-light">
        Kembali
    </a>
</nav>

<div class="container">

    @if(empty($cart))
        <div class="alert alert-light text-dark">
            Keranjang masih kosong.
        </div>
    @else

        @foreach($cart as $index => $item)
        <div class="card mb-3">
            <div class="card-body">

                <h5 class="fw-bold">{{ $item['nama_menu'] ?? '' }}</h5>

                <p>
                    Harga Dasar :
                    Rp {{ number_format($item['harga_dasar'] ?? 0) }}
                </p>

                @if(!empty($item['topping']))
                    <p class="mb-1">Topping:</p>
                    <ul>
                        @foreach ($item['topping'] as $t)
                            <li>
                                {{ $t['nama_topping'] ?? '' }}
                                (Rp {{ number_format($t['harga_topping'] ?? 0) }})
                            </li>
                        @endforeach
                    </ul>
                @endif

                <p class="fw-bold text-danger">
                    Subtotal: Rp {{ number_format($item['subtotal'] ?? 0) }}
                </p>

                <form action="/cart/remove/{{ $index }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">
                        Hapus
                    </button>
                </form>

            </div>
        </div>
        @endforeach

        <div class="card bg-danger text-white p-3 mb-3">
            <h4>Total: Rp {{ number_format($total ?? 0) }}</h4>
        </div>

        @auth
            <a href="{{ route('checkout.index') }}" class="btn btn-warning w-100">
                Checkout
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-warning w-100">
                Login untuk Checkout
            </a>
        @endauth

        <form action="/cart/clear" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-outline-dark w-100">
                Kosongkan Keranjang
            </button>
        </form>

    @endif

</div>

@endsection