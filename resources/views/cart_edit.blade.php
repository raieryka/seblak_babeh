@extends('layouts.app')

@section('content')

<div class="container mt-5">

<a href="{{ route('cart') }}" class="btn btn-light mb-3">← Kembali</a>

<div class="card bg-danger text-white shadow border-0">

<div class="card-body">

<h4 class="fw-bold mb-3">{{ $menu->nama_menu }}</h4>

<form action="{{ route('cart.edit.update', $index) }}" method="POST">
@csrf

<h5 class="mb-3">Pilih Topping :</h5>

<div class="row">

@foreach($topping as $t)

<div class="col-md-6 col-lg-4 mb-4">

<div class="bg-white rounded-4 p-3 shadow-sm text-dark">

<img src="{{ asset('images/topping_seblak/' . $t->gambar) }}"
class="img-fluid mb-2 rounded"
style="height:180px; object-fit:cover; width:100%;">

<div class="fw-bold">
{{ $t->nama_topping }}
</div>

<div class="text-danger mb-2">
Rp {{ number_format($t->harga_topping) }}
</div>

<button type="button"
class="btn btn-sm w-100 pilih-btn 
{{ collect($item['topping'])->pluck('id_topping')->contains($t->id_topping) ? 'active' : '' }}"
data-harga="{{ $t->harga_topping }}"
onclick="toggleTopping(this)">

{{ collect($item['topping'])->pluck('id_topping')->contains($t->id_topping) ? '✔ Dipilih' : 'Tambah' }}

</button>

<input type="hidden"
name="topping[]"
value="{{ $t->id_topping }}"
class="topping-input"
{{ collect($item['topping'])->pluck('id_topping')->contains($t->id_topping) ? '' : 'disabled' }}>

</div>

</div>

@endforeach

</div>

<button type="submit" class="btn btn-success w-100 rounded-3">
Simpan Perubahan
</button>

</form>

</div>
</div>

</div>

<style>
.pilih-btn{
background:#dc3545;
color:#fff;
border:none;
border-radius:8px;
font-weight:bold;
}

.pilih-btn.active{
background:#28a745;
}
</style>

<script>
function toggleTopping(btn){

let input = btn.nextElementSibling;

if(btn.classList.contains("active")){
btn.classList.remove("active");
btn.innerHTML = "Tambah";
input.disabled = true;
}else{
btn.classList.add("active");
btn.innerHTML = "✔ Dipilih";
input.disabled = false;
}

}
</script>

@endsection