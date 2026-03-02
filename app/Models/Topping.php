<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penjual;
use App\Models\DetailTopping;

class Topping extends Model
{
    protected $table = 'topping';
    protected $primaryKey = 'id_topping';
    public $timestamps = false;

    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'id_penjual');
    }

    public function detailTopping()
    {
        return $this->hasMany(DetailTopping::class, 'id_topping');
    }
}