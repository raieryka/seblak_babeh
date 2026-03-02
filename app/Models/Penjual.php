<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\Topping;

class Penjual extends Model
{
    protected $table = 'penjual';
    protected $primaryKey = 'id_penjual';
    public $timestamps = false;

    protected $fillable = [
    'nama_usaha',
    'nama_pemilik',
    'alamat',
    'no_hp',
    'jam_buka',
    'jam_tutup',
    'deskripsi',
    'foto_usaha'
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'id_penjual');
    }

    public function topping()
    {
        return $this->hasMany(Topping::class, 'id_penjual');
    }
}