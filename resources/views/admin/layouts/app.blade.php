<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Seblak Babeh</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa; /* Lighter background for dashboard */
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background-color: #3d0000;
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #5a0000;
            text-align: center;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 15px 20px;
            font-size: 1.1em;
            display: block;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s;
        }

        #sidebar ul li a:hover {
            background: #8b0000;
            color: #ffcc00;
        }

        #sidebar ul li a i {
            margin-right: 10px;
        }

        /* Active Link */
        #sidebar ul li.active > a {
            background: #cd0619;
            color: #fff;
            border-left: 5px solid #ffcc00;
        }

        /* Navbar Styling */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .content-area {
            width: 100%;
            padding: 20px;
        }

        /* Card and Buttons */
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-merah {
            background-color: #cd0619;
            color: white;
        }
        .btn-merah:hover {
            background-color: #a30000;
            color: white;
        }

        .text-babeh {
            color: #cd0619;
        }
    </style>
</head>
<body class="d-flex">

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold m-0"><span style="color:#ffcc00">Admin</span> Babeh</h4>
        </div>

        <ul class="list-unstyled components mt-3">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('menu.*') ? 'active' : '' }}">
                <a href="{{ route('menu.index') }}"><i class="fas fa-utensils"></i> Manajemen Menu</a>
            </li>
            <li class="{{ request()->routeIs('topping.*') ? 'active' : '' }}">
                <a href="{{ route('topping.index') }}"><i class="fas fa-pepper-hot"></i> Manajemen Topping</a>
            </li>
            <li class="{{ request()->routeIs('pesanan.*') ? 'active' : '' }}">
                <a href="{{ route('pesanan.index') }}"><i class="fas fa-shopping-cart"></i> Manajemen Pesanan</a>
            </li>
            <li>
                <a href="{{ route('home') }}"><i class="fas fa-globe"></i> Lihat Website</a>
            </li>
            <li class="mt-4">
                <form method="POST" action="{{ route('logout') }}" class="px-3">
                    @csrf
                    <button type="submit" class="btn btn-warning w-100 fw-bold">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Page Content Area -->
    <div class="content-area">
        
        <nav class="navbar navbar-expand-lg navbar-custom mb-4 rounded px-3 py-2">
            <div class="container-fluid">
                <div class="ms-auto fw-bold text-dark">
                    Halo, {{ auth()->user()->name ?? 'Admin' }}
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            {{-- FLASH MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success fw-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger fw-bold">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(() => {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.style.transition = "0.5s";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 4000);
    </script>
</body>
</html>
