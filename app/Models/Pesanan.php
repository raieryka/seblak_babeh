<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $primaryKey = 'id_pesanan';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false; // 🔥 TAMBAH INI

    protected $fillable = [
        'user_id',
        'nama_pelanggan',
        'no_hp',
        'alamat',
        'total_harga',
        'metode_bayar',
        'status_pesanan'
    ];

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }
}