<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPesanan;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false;

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }

    
}