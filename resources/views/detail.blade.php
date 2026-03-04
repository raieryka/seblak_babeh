<!DOCTYPE html>
<html>
<head>
    <title>{{ $menu->nama_menu }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <a href="/" class="btn btn-light mb-3">← Kembali</a>

    <div class="card bg-danger text-white shadow-lg">
        <div class="card-body">

            {{-- FOTO MENU --}}
            <img src="{{ asset('images/' . $menu->gambar) }}" 
                 class="img-fluid mb-3 rounded"
                 style="height:300px; object-fit:cover; width:100%;">

            <h3>{{ $menu->nama_menu }}</h3>
            <p class="fs-5">Harga Dasar: Rp {{ number_format($menu->harga_dasar) }}</p>

            <form action="/cart/add" method="POST">
                @csrf
                <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">

                {{-- CEK: HANYA TAMPILKAN TOPPING JIKA MENU SEBLAK --}}
                @if(str_contains(strtolower($menu->nama_menu), 'seblak'))

                    <h5 class="mt-3">Pilih Topping:</h5>

                    @foreach($topping as $t)
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="topping[]" 
                               value="{{ $t->id_topping }}">
                        <label class="form-check-label">
                            {{ $t->nama_topping }} 
                            (+Rp {{ number_format($t->harga_topping) }})
                        </label>
                    </div>
                    @endforeach

                @endif

                <button type="submit" class="btn btn-dark mt-3 w-100">
                    ➕ Tambah+
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html>