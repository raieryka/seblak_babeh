<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seblak Babeh</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap (kalau kamu pakai) -->
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
    @yield('content')
</div>

</body>
</html>