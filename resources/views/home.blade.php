@extends('layouts.app')

@section('content')

<!-- ========================= -->
<!-- HERO SECTION -->
<!-- ========================= -->
<section class="hero-section d-flex align-items-center">

    <div class="container position-relative hero-content text-white">
            
        <p class="status-bubble">BUKA SETIAP HARI</p>

        <h1 class="fw-bold display-3">
            Warung <br>
            Seblak <span class="text-warning">Babeh</span>
        </h1>

        <p class="mt-3 mb-4 col-md-6">
            Perpaduan bumbu khas Babeh dengan pilihan topping melimpah.<br>
            Rasakan nikmatnya seblak yang bisa kamu atur sendiri kepedasannya.
        </p>

        <a href="#menu" class="menu-bubble">Lihat Menu Sekarang</a>

    </div>

</section>


<!-- ========================= -->
<!-- SECTION KEUNGGULAN -->
<!-- ========================= -->

<section class="keunggulan-wrapper">

    <div class="container">
        <div class="keunggulan-section py-5">
            <div class="row text-center text-white">

                <div class="col-md-4 mb-4">
                    <div class="keunggulan-box">
                        <div class="icon-circle">🌶️</div>
                        <h4 class="mt-4 fw-bold">Bumbu Seblak Nampol</h4>
                        <p>
                            Resep khas <span class="text-babeh">Babeh</span>, 
                            pedasnya nendang dan bikin nagih!
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="keunggulan-box">
                        <div class="icon-circle">🔥</div>
                        <h4 class="mt-4 fw-bold">Level Pedas Bebas</h4>
                        <p>
                            Dari level santai sampai level neraka, 
                            kamu tentukan sendiri!
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="keunggulan-box">
                        <div class="icon-circle">🥘</div>
                        <h4 class="mt-4 fw-bold">Topping Melimpah</h4>
                        <p>
                            Bakso, ceker, sosis, makaroni dan banyak pilihan favorit!
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>


<!-- ========================= -->
<!-- DAFTAR MENU -->
<!-- ========================= -->

<div class="container mb-5" id="menu">
    <div class="row">
        @foreach($menu as $m)
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 menu-card">

                <img src="{{ asset('images/' . $m->gambar) }}"
                     style="height:220px; object-fit:cover;">

                <div class="card-body text-dark">

                    <h5 class="card-title fw-bold">
                        {{ $m->nama_menu }}
                    </h5>

                    <p class="text-danger fw-bold">
                        Rp {{ number_format($m->harga_dasar) }}
                    </p>

                    <a href="{{ url('/menu/' . $m->id_menu) }}"
                       class="btn btn-danger w-100">
                        Tambah Keranjang
                    </a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


<!-- ========================= -->
<!-- STYLE -->
<!-- ========================= -->

<style>

/* Bubble status */
.status-bubble {
    display: inline-block;
    background: #ffcc00;
    color: #d00000;
    padding: 6px 16px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 15px;
}

/* Tombol menu */
.menu-bubble {
    display: inline-block;
    background: #ffcc00;
    color: #d00000;
    padding: 18px 28px;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    transition: 0.3s ease;
}

.menu-bubble:hover {
    background: #ffb300;
    transform: scale(1.05);
}

/* WRAPPER JARAK */
.keunggulan-wrapper {
    margin-top: 120px;
    margin-bottom: 120px;
}

/* BOX MERAH BESAR */
.keunggulan-section {
    background-color: #cd0619;
    padding: 120px 40px;
    border-radius: 25px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.25);
}

</style>

@endsection