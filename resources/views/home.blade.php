<!DOCTYPE html>
<html>
<head>
    <title>Seblak Babeh</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #5a0000;
        }

        .navbar {
            background-color: #3d0000;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .btn-merah {
            background-color: #8b0000;
            color: white;
        }

        .btn-merah:hover {
            background-color: #a30000;
            color: white;
        }
    </style>
</head>

<body class="text-white">

<!-- Navbar -->
<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand fw-bold">
        🔥 Seblak Babeh
    </span>

    <a href="/cart" class="btn btn-merah">
        <i class="bi bi-cart-fill"></i> Keranjang
    </a>
</nav>

<div class="container mt-5">

    <!-- Hero -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Seblak Prasmanan Pedas</h1>
        <p>Pilih menu favorit kamu sekarang juga!</p>
    </div>

    <!-- Menu List -->
    <div class="row">
        @foreach($menu as $m)
        <div class="col-md-4 mb-4">
            <div class="card shadow">

                <!-- Gambar Menu -->
                <img src="{{ asset('menu/' . $m->gambar) }}" 
                     style="height:220px; object-fit:cover;">

                <div class="card-body text-dark">

                    <h5 class="card-title fw-bold">
                        {{ $m->nama_menu }}
                    </h5>

                    <p class="text-danger fw-bold">
                        Rp {{ number_format($m->harga_dasar) }}
                    </p>

                    <a href="/menu/{{ $m->id_menu }}" 
                       class="btn btn-merah w-100">
                        <i class="bi bi-eye-fill"></i> Lihat Menu
                    </a>

                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

</body>
</html>