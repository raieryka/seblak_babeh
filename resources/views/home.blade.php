<!DOCTYPE html>
<html>
<head>
    <title>Seblak Babeh</title>
</head>
<body>

    <h1>Seblak Babeh</h1>
    <h2>Menu Utama</h2>

    @foreach($menu as $m)
        <p>{{ $m->nama_menu }} - Rp{{ $m->harga_dasar }}</p>
    @endforeach

    <h2>Topping</h2>

    @foreach($topping as $t)
        <p>{{ $t->nama_topping }} - Rp{{ $t->harga_topping }}</p>
    @endforeach

</body>
</html>