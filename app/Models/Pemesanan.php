<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_user
 * @property \Illuminate\Support\Carbon $tanggal_pesan
 * @property \Illuminate\Support\Carbon $tanggal_kunjungan
 * @property \Illuminate\Support\Carbon $tanggal_berakhir
 * @property int $total_harga
 * @property string $status
 */
class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'tanggal_pesan', 'tanggal_kunjungan', 'tanggal_berakhir', 'total_harga', 'status'];

    protected $casts = [
        'tanggal_pesan' => 'datetime',
        'tanggal_kunjungan' => 'date',
        'tanggal_berakhir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detailPemesanans()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_pemesanan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pemesanan');
    }

    // 1. Relasi ini untuk melayani query yang memanggil 'tiket'
    public function tiket()
    {
        return $this->hasOne(ETiket::class, 'id_pemesanan');
    }

    // 2. Relasi ini untuk melayani query login visitor yang memanggil 'eTiket'
    public function eTiket()
    {
        return $this->hasOne(ETiket::class, 'id_pemesanan');
    }
}
