<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;
use App\Models\Menu;
use App\Models\DetailTopping;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $primaryKey = 'id_detail';
    public $timestamps = false;

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public function detailTopping()
    {
        return $this->hasMany(DetailTopping::class, 'id_detail');
    }
}