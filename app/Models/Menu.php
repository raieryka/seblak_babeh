<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penjual;
use App\Models\DetailPesanan;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;

    protected $fillable = [
        'id_penjual',
        'nama_menu',
        'harga_dasar',
        'deskripsi',
        'status',
        'stok',
        'gambar',
        'is_custom'
    ];

    // Relasi ke penjual
    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'id_penjual');
    }

    // Relasi ke detail pesanan
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_menu');
    }
}