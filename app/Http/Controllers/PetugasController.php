<?php

namespace App\Http\Controllers;

use App\Models\ETiket;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function scan()
    {
        return view('petugas.scan', [
            'pendingPayments' => Pembayaran::where('status_bayar', 'pending')->count(),
            'usedTickets' => ETiket::where('status_tiket', 'digunakan')->count(),
            'activeTickets' => ETiket::where('status_tiket', 'aktif')->count(),
            'todayBookings' => Pemesanan::whereDate('tanggal_kunjungan', today())->count(),
        ]);
    }

    public function verify(Request $request)
    {
        $data = $request->validate(['kode_qr' => 'required|string']);
        $eTiket = ETiket::with('pemesanan.user', 'pemesanan.tiket')->where('kode_qr', $data['kode_qr'])->first();

        if (! $eTiket) return back()->with('error', 'Kode QR tidak ditemukan.');
        if ($eTiket->status_tiket === 'digunakan') return back()->with('error', 'Tiket sudah digunakan sebelumnya.');

        $eTiket->update(['status_tiket' => 'digunakan']);
        $eTiket->pemesanan->update(['status' => 'selesai']);

        return back()->with('success', 'Tiket valid. Status diubah menjadi digunakan.')->with('verifiedTicket', $eTiket);
    }
}
