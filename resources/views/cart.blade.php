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

<div class="container py-4">

    {{-- 🔍 SEARCH --}}
    <div class="mb-3">
        <input type="text" id="searchCart" class="form-control"
               placeholder="🔍 Cari menu..."
               onkeyup="filterCart()">
    </div>

    @if(empty($cart))
        <div class="alert alert-light text-dark">
            Keranjang masih kosong.
        </div>
    @else

        @foreach($cart as $index => $item)
        <div class="card mb-3 shadow-sm rounded-4 border-0 cart-item"
             data-name="{{ strtolower($item['nama_menu']) }}">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>
                        <h5 class="fw-bold mb-1">
                            {{ $item['nama_menu'] ?? '' }}
                        </h5>

                        @if(empty($item['topping']))
                            <p class="mb-0 text-muted" style="font-size:14px;">
                                Rp {{ number_format($item['harga_dasar'] ?? 0) }}
                            </p>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-2">

                        <form action="{{ route('cart.update', $index) }}" method="POST">
                            @csrf
                            <input type="hidden" name="jumlah" value="{{ $item['jumlah'] - 1 }}">
                            <button class="btn btn-sm btn-danger rounded-circle px-2">−</button>
                        </form>

                        <span class="fw-bold">
                            {{ $item['jumlah'] }}
                        </span>

                        <form action="{{ route('cart.update', $index) }}" method="POST">
                            @csrf
                            <input type="hidden" name="jumlah" value="{{ $item['jumlah'] + 1 }}">
                            <button class="btn btn-sm btn-success rounded-circle px-2">+</button>
                        </form>

                    </div>

                </div>

                @if(!empty($item['topping']))
                    <p class="mb-1 fw-semibold">Topping:</p>
                    <ul class="mb-2">
                        @foreach ($item['topping'] as $t)
                            <li>
                                {{ $t['nama_topping'] ?? '' }}
                                (Rp {{ number_format($t['harga_topping'] ?? 0) }})
                            </li>
                        @endforeach
                    </ul>
                @endif

                <p class="fw-bold text-danger mb-2">
                    Subtotal:
                    Rp {{ number_format($item['subtotal'] ?? 0) }}
                </p>

                <div class="d-flex gap-2 mt-2">
                    <form action="/cart/remove/{{ $index }}" method="POST" class="flex-grow-1">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger w-100 rounded-3">
                            Hapus
                        </button>
                    </form>

                    <a href="{{ route('cart.edit', $index) }}" class="btn btn-sm btn-outline-primary w-100 rounded-3">
                        Edit
                    </a>
                </div>

            </div>
        </div>
        @endforeach

        <div class="card bg-danger text-white p-3 mb-3 rounded-4 border-0 shadow-sm">
            <h4 class="mb-0">
                Total:
                Rp {{ number_format($total ?? 0) }}
            </h4>
        </div>

        @auth
            <a href="{{ route('checkout.index') }}"
               class="btn btn-warning w-100 rounded-3 fw-bold">
                Checkout
            </a>
        @else
            <a href="{{ route('login') }}"
               class="btn btn-warning w-100 rounded-3 fw-bold">
                Login untuk Checkout
            </a>
        @endauth

        <form action="/cart/clear" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-outline-dark w-100 rounded-3">
                Kosongkan Keranjang
            </button>
        </form>

    @endif

</div>

{{-- 🔥 SCRIPT FILTER --}}
<script>
function filterCart() {
    let input = document.getElementById("searchCart").value.toLowerCase();
    let items = document.querySelectorAll(".cart-item");

    items.forEach(function(item){
        let name = item.getAttribute("data-name");

        if(name.includes(input)){
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
}
</script>

@endsection