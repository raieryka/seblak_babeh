<!DOCTYPE html>
<html>
<head>
    <title>{{ $menu->nama_menu }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .topping-card {
            background: #ffffff;
            color: #000;
            border-radius: 15px;
            transition: all 0.2s ease;
            border: none;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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
    </style>
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

            <p class="fs-5">
                Harga Dasar: Rp 0
            </p>

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
                                    data-id="{{ $t->id_topping }}"
                                    data-harga="{{ $t->harga_topping }}">
                                + Keranjang
                            </button>

                        </div>

                    </div>
                    @endforeach

                </div>

                @endif

                <h4 class="mt-4">
                    Total: Rp <span id="totalHarga">0</span>
                </h4>

                <div id="selectedTopping"></div>

                <button type="submit" class="btn btn-dark mt-3 w-100">
                    ➕ Tambah+
                </button>

            </form>

        </div>
    </div>

</div>

<script>
let total = 0;

document.querySelectorAll('.addTopping').forEach(button => {

    button.addEventListener('click', function() {

        let harga = parseInt(this.dataset.harga);
        let id = this.dataset.id;

        // CEK APAKAH SUDAH DIPILIH
        if (this.classList.contains('selected')) {

            // KALAU SUDAH DIPILIH → HAPUS
            total -= harga;
            this.classList.remove("selected");
            this.classList.remove("btn-success");
            this.classList.add("btn-danger");
            this.innerText = "+ Keranjang";

            // HAPUS INPUT HIDDEN
            document.querySelectorAll('input[name="topping[]"]').forEach(input => {
                if (input.value == id) {
                    input.remove();
                }
            });

        } else {

            // KALAU BELUM DIPILIH → TAMBAH
            total += harga;
            this.classList.add("selected");
            this.classList.remove("btn-danger");
            this.classList.add("btn-success");
            this.innerText = "✓ Dipilih";

            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "topping[]";
            input.value = id;

            document.getElementById('selectedTopping').appendChild(input);
        }

        // UPDATE TOTAL
        document.getElementById('totalHarga').innerText = total.toLocaleString();
    });

});
</script>

</body>
</html>