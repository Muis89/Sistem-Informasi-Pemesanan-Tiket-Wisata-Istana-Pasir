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
        $pemesanans = $request->user()->pemesanans()->with(['detailPemesanans.tiket', 'pembayaran', 'eTiket'])->latest()->get();
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
            'tikets' => ['required', 'array', 'min:1'],
            'tikets.*.id' => ['required', 'exists:tikets,id'],
            'tikets.*.quantity' => ['required', 'integer', 'min:1', 'max:50'],
            'visit_start_date' => ['required', 'date', 'after_or_equal:today'],
            'visit_end_date' => ['required', 'date', 'after_or_equal:visit_start_date'],
        ]);

        $totalHarga = 0;
        $items = [];

        foreach ($data['tikets'] as $item) {
            $tiket = Tiket::findOrFail($item['id']);
            if ($tiket->stok < $item['quantity']) {
                return back()->withErrors(['message' => 'Stok tiket ' . $tiket->nama_tiket . ' tidak mencukupi.']);
            }
            $items[] = ['tiket' => $tiket, 'quantity' => $item['quantity']];
            $totalHarga += $tiket->harga * $item['quantity'];
        }

        $pemesanan = Pemesanan::create([
            'id_user' => $request->user()->id,
            'tanggal_pesan' => now(),
            'tanggal_kunjungan' => $data['visit_start_date'],
            'tanggal_berakhir' => $data['visit_end_date'],
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            $pemesanan->detailPemesanans()->create([
                'id_tiket' => $item['tiket']->id,
                'jumlah_tiket' => $item['quantity'],
                'subtotal' => $item['tiket']->harga * $item['quantity'],
            ]);
            $item['tiket']->decrement('stok', $item['quantity']);
        }

        return redirect()->route('visitor.checkout', $pemesanan)->with('success', 'Pemesanan dibuat. Silakan unggah bukti pembayaran.');
    }

    /**
     * @param \App\Models\Pemesanan $pemesanan
     */
    public function checkout(Pemesanan $pemesanan)
    {
        abort_unless($pemesanan->id_user === auth()->id(), 403);

        return view('visitor.checkout', ['pemesanan' => $pemesanan->load('detailPemesanans.tiket', 'pembayaran')]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pemesanan $pemesanan
     */
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

    /**
     * @param \App\Models\Pemesanan $pemesanan
     */
    public function ticket(Pemesanan $pemesanan)
    {
        abort_unless($pemesanan->id_user === auth()->id(), 403);
        $pemesanan->load('detailPemesanans.tiket', 'user', 'eTiket');
        abort_unless($pemesanan->eTiket, 404);

        $this->expireExpiredTickets(collect([$pemesanan]));

        return view('visitor.ticket', ['pemesanan' => $pemesanan->refresh()->load('detailPemesanans.tiket', 'user', 'eTiket')]);
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
