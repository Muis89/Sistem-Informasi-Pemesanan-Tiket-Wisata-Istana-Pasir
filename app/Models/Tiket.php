<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = ['nama_tiket', 'harga', 'stok', 'deskripsi'];

    // 1. Relasi lama kamu (tetap dipertahankan agar tidak merusak fitur lain jika ada yang pakai)
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_tiket');
    }

    // 2. TAMBAHKAN INI: Relasi baru untuk mengatasi error "detailPemesanans" yang dicari aplikasi
    public function detailPemesanans()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_tiket');
    }
}
