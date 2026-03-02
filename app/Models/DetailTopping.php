<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPesanan;
use App\Models\Topping;

class DetailTopping extends Model
{
    protected $table = 'detail_topping';
    protected $primaryKey = 'id_detail_topping';
    public $timestamps = false;

    public function detailPesanan()
    {
        return $this->belongsTo(DetailPesanan::class, 'id_detail');
    }

    public function topping()
    {
        return $this->belongsTo(Topping::class, 'id_topping');
    }
}