<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = ['nama_tiket', 'harga', 'stok', 'deskripsi'];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_tiket');
    }
}
