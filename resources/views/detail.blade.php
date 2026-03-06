<!DOCTYPE html>
<html>
<head>
    <title>{{ $menu->nama_menu }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        /* ===== BACKGROUND PALING LUAR ===== */
        body {
            background: #7a0000; /* merah sama kayak tombol */
            min-height: 100vh;
        }

        /* ===== INFO BOX PUTIH ===== */
        .info-box {
            background: #ffffff;
            color: #000;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        /* ===== TOPPING CARD ===== */
        .topping-card {
            background: #ffffff;
            color: #000;
            border-radius: 15px;
            transition: 0.2s ease;
            border: none;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .topping-card:hover {
            transform: translateY(-3px);
        }

        .topping-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 10px;
        }

        .topping-price {
            font-size: 14px;
            color: #dc3545;
            font-weight: 600;
        }

        /* ===== TOMBOL TAMBAH MERAH ===== */
        .btn-tambah {
            background: #5a0000;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .btn-tambah:hover {
            background: #3d0000;
            transform: translateY(-2px);
        }

    </style>
</head>

<body>

<div class="container mt-5">

    <a href="/" class="btn btn-light mb-3">← Kembali</a>

    <!-- CARD MERAH -->
    <div class="card bg-danger text-white shadow-lg border-0">

        <div class="card-body">

            {{-- FOTO --}}
            <img src="{{ asset('images/' . $menu->gambar) }}"
                 class="img-fluid mb-3 rounded"
                 style="height:300px; object-fit:cover; width:100%;">

            {{-- INFO BOX PUTIH --}}
            <div class="info-box mt-2 mb-3">

                <h4 class="fw-bold">
                    {{ $menu->nama_menu }}
                </h4>

                <p class="mb-1">
                    💰 Harga:
                    Rp {{ number_format($menu->harga_dasar) }}
                </p>

                @if(!empty($menu->deskripsi))
                    <p class="mb-1">
                        📝 {{ $menu->deskripsi }}
                    </p>
                @endif

                <p class="mb-0">
                    📦 Stok:
                    {{ $menu->stok ?? 'Tidak diketahui' }}
                </p>

            </div>

            {{-- FORM --}}
            <form action="/cart/add" method="POST">
                @csrf
                <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">

                @if($menu->is_custom == 1)

                <h5 class="mt-4 mb-3">Pilih Topping:</h5>

                <div class="row">

                    @foreach($topping as $t)
                    <div class="col-md-6 col-lg-4 mb-4">

                        <div class="topping-card">

                            <img src="{{ asset('images/topping_seblak/' . $t->gambar) }}"
                                 class="topping-img">

                            <div class="fw-bold">
                                {{ $t->nama_topping }}
                            </div>

                            <div class="topping-price mb-2">
                                Rp {{ number_format($t->harga_topping) }}
                            </div>

                            <button type="button"
                                    class="btn btn-sm btn-danger w-100 addTopping"
                                    data-id="{{ $t->id_topping }}">
                                + Pilih
                            </button>

                            <input type="hidden"
                                   name="topping[]"
                                   value="{{ $t->id_topping }}"
                                   class="topping-input d-none">

                        </div>

                    </div>
                    @endforeach

                </div>

                @endif

                {{-- TOMBOL TAMBAH --}}
                <button type="submit" class="btn-tambah w-100 mt-3">
                    ➕ Tambah ke Keranjang
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html>