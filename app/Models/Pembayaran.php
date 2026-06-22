<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = ['id_pemesanan', 'tanggal_bayar', 'metode_bayar', 'jumlah_bayar', 'bukti_bayar', 'status_bayar'];

    protected $casts = ['tanggal_bayar' => 'datetime'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
