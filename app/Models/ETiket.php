<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETiket extends Model
{
    use HasFactory;

    protected $table = 'e_tikets';

    protected $fillable = ['id_pemesanan', 'kode_qr', 'tanggal_kirim', 'status_tiket'];

    protected $casts = ['tanggal_kirim' => 'datetime'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
