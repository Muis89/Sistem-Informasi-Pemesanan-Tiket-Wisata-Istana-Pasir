<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'id_tiket', 'tanggal_pesan', 'tanggal_kunjungan', 'tanggal_berakhir', 'jumlah_tiket', 'total_harga', 'status'];

    protected $casts = [
        'tanggal_pesan' => 'datetime',
        'tanggal_kunjungan' => 'date',
        'tanggal_berakhir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'id_tiket');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pemesanan');
    }

    public function eTiket()
    {
        return $this->hasOne(ETiket::class, 'id_pemesanan');
    }
}
