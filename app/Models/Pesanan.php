<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPesanan;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false;

    protected $fillable = [
        'nama_pelanggan',
        'no_hp',
        'alamat',
        'tanggal_pesan',
        'total_harga',
        'status_pesanan',
        'metode_bayar'
    ];

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }
}