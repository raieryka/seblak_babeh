<!DOCTYPE html>
<html>
<head>
<title>{{ $menu->nama_menu }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#7a0000;
    min-height:100vh;
}

.info-box{
    background:#fff;
    color:#000;
    border-radius:20px;
    padding:20px;
}

.topping-card{
    background:#fff;
    border-radius:15px;
    padding:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    color:#000;
}

.topping-img{
    width:100%;
    height:180px;
    object-fit:cover;
    border-radius:10px;
    margin-bottom:10px;
}

.topping-price{
    color:#dc3545;
    font-weight:600;
    font-size:14px;
}

.pilih-btn{
    background:#dc3545;
    border:none;
    color:#fff;
    width:100%;
    padding:8px;
    border-radius:8px;
    font-weight:bold;
    transition:0.2s;
}

.pilih-btn.active{
    background:#28a745;
}

.btn-tambah{
    background:#5a0000;
    color:#fff;
    border:none;
    border-radius:10px;
    padding:12px;
    font-weight:bold;
}

.total-box{
    background:#ffffff;
    color:#000;
    border-radius:15px;
    padding:20px;
    margin-top:20px;
    text-align:center;
}
</style>
</head>

<body>

<div class="container mt-5">

<a href="/" class="btn btn-light mb-3">← Kembali</a>

<div class="card bg-danger text-white shadow border-0">
<div class="card-body">

<img src="{{ asset('images/' . $menu->gambar) }}"
class="img-fluid mb-3 rounded"
style="height:300px; object-fit:cover; width:100%;">

<div class="info-box mb-3">
<h4 class="fw-bold">{{ $menu->nama_menu }}</h4>

<p>💰 Harga :
<b>
@if($menu->is_custom == 1)
    Harga menyesuaikan topping
@else
    Rp {{ number_format($menu->harga_dasar) }}
@endif
</b></p>

@if(!empty($menu->deskripsi))
<p>📝 {{ $menu->deskripsi }}</p>
@endif
</div>

<form action="/cart/add" method="POST">
@csrf
<input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">

@if($menu->is_custom == 1)

<h5 class="mb-3">Pilih Topping :</h5>

<!-- 🔍 Search Topping -->
<div class="mb-3">
    <input type="text" id="searchTopping" class="form-control" placeholder="🔍 Cari topping..." onkeyup="filterTopping()">
</div>

<div class="row">
@foreach($topping as $t)
<div class="col-md-6 col-lg-4 mb-4 topping-item" data-name="{{ strtolower($t->nama_topping) }}">
<div class="topping-card">

<img src="{{ asset('images/topping_seblak/' . $t->gambar) }}"
class="topping-img">

<div class="fw-bold mt-2" style="font-size:16px;">
{{ $t->nama_topping }}
</div>

<div class="topping-price mb-2">
Rp {{ number_format($t->harga_topping) }}
</div>

@if($t->stok <= 0)
    <button type="button" class="btn btn-secondary w-100 fw-bold" disabled>Habis</button>
@else
    <button type="button" class="pilih-btn" data-harga="{{ $t->harga_topping ?? $t->harga }}" onclick="toggleTopping(this)">
        Tambah
    </button>
@endif

<input type="hidden"
name="topping[]"
value="{{ $t->id_topping }}"
class="topping-input"
disabled>

<input type="hidden"
name="harga_topping[{{ $t->id_topping }}]"
value="{{ $t->harga_topping }}"
class="harga-topping-input"
disabled>

</div>
</div>
@endforeach
</div>

<!-- TOTAL HARGA -->
<div class="total-box">
<h5>Total Harga :
<b id="totalHarga">Rp 0</b></h5>
</div>

<input type="hidden" name="total_harga" id="harga_total_input" value="0">

@endif

@if($menu->stok <= 0)
    <button type="button" class="btn btn-secondary w-100 mt-3 fw-bold" disabled>
        ✖ Menu Habis
    </button>
@else
    <button type="submit" class="btn-tambah w-100 mt-3">
        ➕ Tambah ke Keranjang
    </button>
@endif

</form>

</div>
</div>

</div>

@if($menu->is_custom == 1)
<script>
let totalTopping = 0;

function rupiah(angka){
    return "Rp " + angka.toLocaleString("id-ID");
}

function toggleTopping(btn){
    let inputTopping = btn.nextElementSibling;
    let hargaToppingInput = inputTopping.nextElementSibling;
    let harga = parseInt(btn.dataset.harga);

    if(btn.classList.contains("active")){
        btn.classList.remove("active");
        btn.innerHTML = "Tambah";
        inputTopping.disabled = true;
        hargaToppingInput.disabled = true;
        totalTopping -= harga;
    } else {
        btn.classList.add("active");
        btn.innerHTML = "✔ Ditambah";
        inputTopping.disabled = false;
        hargaToppingInput.disabled = false;
        totalTopping += harga;
    }

    document.getElementById("totalHarga").innerHTML = rupiah(totalTopping);
    document.getElementById("harga_total_input").value = totalTopping;
}

// 🔥 Filter Topping
function filterTopping(){
    let input = document.getElementById("searchTopping").value.toLowerCase();
    let items = document.querySelectorAll(".topping-item");

    items.forEach(function(item){
        let name = item.getAttribute("data-name");
        item.style.display = name.includes(input) ? "block" : "none";
    });
}
</script>
@endif

</body>
</html>