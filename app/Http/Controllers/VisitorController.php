<?php

namespace App\Http\Controllers;

use App\Models\ETiket;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VisitorController extends Controller
{
    public function dashboard(Request $request)
    {
        $pemesanans = $request->user()->pemesanans()->with(['tiket', 'pembayaran', 'eTiket'])->latest()->get();
        $this->expireExpiredTickets($pemesanans);

        return view('visitor.dashboard', compact('pemesanans'));
    }

    public function book()
    {
        return view('visitor.book', ['tikets' => Tiket::where('stok', '>', 0)->get()]);
    }

    public function storeBooking(Request $request)
    {
        $data = $request->validate([
            'id_tiket' => ['required', 'exists:tikets,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:50'],
            'visit_start_date' => ['required', 'date', 'after_or_equal:today'],
            'visit_end_date' => ['required', 'date', 'after_or_equal:visit_start_date'],
        ]);

        $tiket = Tiket::findOrFail($data['id_tiket']);
        abort_if($tiket->stok < $data['quantity'], 422, 'Stok tiket tidak mencukupi.');

        $pemesanan = Pemesanan::create([
            'id_user' => $request->user()->id,
            'id_tiket' => $tiket->id,
            'tanggal_pesan' => now(),
            'tanggal_kunjungan' => $data['visit_start_date'],
            'tanggal_berakhir' => $data['visit_end_date'],
            'jumlah_tiket' => $data['quantity'],
            'total_harga' => $tiket->harga * $data['quantity'],
            'status' => 'pending',
        ]);

        $tiket->decrement('stok', $data['quantity']);

        return redirect()->route('visitor.checkout', $pemesanan)->with('success', 'Pemesanan dibuat. Silakan unggah bukti pembayaran.');
    }

    public function checkout(Pemesanan $pemesanan)
    {
        abort_unless($pemesanan->id_user === auth()->id(), 403);

        return view('visitor.checkout', ['pemesanan' => $pemesanan->load('tiket', 'pembayaran')]);
    }

    public function uploadPayment(Request $request, Pemesanan $pemesanan)
    {
        abort_unless($pemesanan->id_user === auth()->id(), 403);

        if ($this->isVisitDateExpired($pemesanan)) {
            return redirect()->route('visitor.dashboard')->with('error', 'Tanggal kunjungan sudah lewat. Pemesanan ini sudah kadaluarsa dan tidak dapat dibayar. Silakan pesan tiket baru.');
        }

        $data = $request->validate([
            'bukti_bayar' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $path = $data['bukti_bayar']->store('bukti-pembayaran', 'public');

        Pembayaran::updateOrCreate(
            ['id_pemesanan' => $pemesanan->id],
            ['tanggal_bayar' => now(), 'metode_bayar' => 'Transfer Bank Manual', 'jumlah_bayar' => $pemesanan->total_harga, 'bukti_bayar' => $path, 'status_bayar' => 'pending']
        );

        return redirect()->route('visitor.dashboard')->with('success', 'Bukti pembayaran terkirim dan menunggu validasi admin.');
    }

    public function ticket(Pemesanan $pemesanan)
    {
        abort_unless($pemesanan->id_user === auth()->id(), 403);
        $pemesanan->load('tiket', 'user', 'eTiket');
        abort_unless($pemesanan->eTiket, 404);

        $this->expireExpiredTickets(collect([$pemesanan]));

        return view('visitor.ticket', ['pemesanan' => $pemesanan->refresh()->load('tiket', 'user', 'eTiket')]);
    }

    private function expireExpiredTickets($pemesanans): void
    {
        foreach ($pemesanans as $pemesanan) {
            if ($this->isVisitDateExpired($pemesanan) && $pemesanan->eTiket?->status_tiket === 'aktif') {
                $pemesanan->eTiket->update(['status_tiket' => 'kadaluarsa']);
                $pemesanan->setRelation('eTiket', $pemesanan->eTiket->fresh());
            }
        }
    }

    private function isVisitDateExpired(Pemesanan $pemesanan): bool
    {
        $validUntil = $pemesanan->tanggal_berakhir ?? $pemesanan->tanggal_kunjungan;

        return $validUntil !== null && $validUntil->lt(today());
    }
}
