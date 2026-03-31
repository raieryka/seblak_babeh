<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seblak Babeh</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #5a0000;
        font-family: 'Segoe UI', sans-serif;
    }

    .navbar-custom {
        background-color: #3d0000;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .navbar-custom a,
    .navbar-custom span {
        color: white !important;
    }

    .navbar-custom a:hover {
        opacity: 0.8;
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

    .container {
        margin-top: 40px;
    }

    .alert-custom {
        border-radius: 10px;
        text-align: center;
        font-weight: 500;
    }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom px-4">
    <a class="navbar-brand text-white fw-bold" href="{{ route('home') }}">
        Seblak Babeh
    </a>

    <div class="ms-auto d-flex align-items-center gap-3">

        <a href="{{ route('cart') }}" class="text-white text-decoration-none">
            Keranjang
        </a>

        @auth
            {{-- 🔥 TAMBAHAN RIWAYAT --}}
            <a href="{{ route('riwayat') }}" class="text-white text-decoration-none">
                Riwayat
            </a>

            <span>Halo, {{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-white text-decoration-none">
                Login
            </a>
            <a href="{{ route('register') }}" class="text-white text-decoration-none">
                Register
            </a>
        @endauth

    </div>
</nav>

<div class="container mt-4">

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-custom">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-custom">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

</div>

<script>
    setTimeout(() => {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.style.transition = "0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>

</body>
</html>