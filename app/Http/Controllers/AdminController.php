<?php

namespace App\Http\Controllers;

use App\Models\ETiket;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $recentBookings = Pemesanan::with(['user', 'detailPemesanans.tiket', 'pembayaran'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalVisitors' => \App\Models\DetailPemesanan::sum('jumlah_tiket'),
            'totalBookings' => Pemesanan::count(),
            'totalPayments' => Pembayaran::where('status_bayar', 'berhasil')->count(),
            'pendingPayments' => Pembayaran::where('status_bayar', 'pending')->count(),
            'revenue' => Pembayaran::where('status_bayar', 'berhasil')->sum('jumlah_bayar'),
            'recentBookings' => $recentBookings,
            'tikets' => Tiket::latest()->get(),
        ]);
    }

    public function tickets()
    {
        return view('admin.tickets', ['tikets' => Tiket::latest()->get()]);
    }

    public function storeTicket(Request $request)
    {
        Tiket::create($request->validate(['nama_tiket' => 'required|max:255', 'harga' => 'required|integer|min:0', 'stok' => 'required|integer|min:0', 'deskripsi' => 'nullable']));
        return back()->with('success', 'Data tiket berhasil ditambahkan.');
    }

    public function updateTicket(Request $request, Tiket $tiket)
    {
        $tiket->update($request->validate(['nama_tiket' => 'required|max:255', 'harga' => 'required|integer|min:0', 'stok' => 'required|integer|min:0', 'deskripsi' => 'nullable']));
        return back()->with('success', 'Data tiket berhasil diperbarui.');
    }

    public function destroyTicket(Tiket $tiket)
    {
        $tiket->delete();
        return back()->with('success', 'Data tiket berhasil dihapus.');
    }

    public function bookings(Request $request)
    {
        $allPemesanans = Pemesanan::with(['user', 'detailPemesanans.tiket', 'pembayaran', 'eTiket'])->latest()->get();
        $this->expireExpiredTickets($allPemesanans);

        $pemesanans = $allPemesanans;
        if ($request->input('status_tiket') === 'kadaluarsa') {
            $pemesanans = $allPemesanans->filter(fn ($pemesanan) => $pemesanan->eTiket?->status_tiket === 'kadaluarsa')->values();
        }

        if ($request->input('status_tiket') === 'aktif') {
            $pemesanans = $allPemesanans->filter(fn ($pemesanan) => $pemesanan->eTiket?->status_tiket === 'aktif')->values();
        }

        if ($request->input('status_tiket') === 'digunakan') {
            $pemesanans = $allPemesanans->filter(fn ($pemesanan) => $pemesanan->eTiket?->status_tiket === 'digunakan')->values();
        }

        return view('admin.bookings', [
            'pemesanans' => $pemesanans,
            'totalKadaluarsa' => $allPemesanans->filter(fn ($pemesanan) => $pemesanan->eTiket?->status_tiket === 'kadaluarsa')->count(),
            'totalAktif' => $allPemesanans->filter(fn ($pemesanan) => $pemesanan->eTiket?->status_tiket === 'aktif')->count(),
            'totalDigunakan' => $allPemesanans->filter(fn ($pemesanan) => $pemesanan->eTiket?->status_tiket === 'digunakan')->count(),
            'selectedTicketStatus' => $request->input('status_tiket', 'semua'),
        ]);
    }

    public function payments()
    {
        return view('admin.payments', ['pembayarans' => Pembayaran::with('pemesanan.user', 'pemesanan.detailPemesanans.tiket')->latest()->get()]);
    }

    public function paymentProof(Pembayaran $pembayaran)
    {
        abort_unless($pembayaran->bukti_bayar && Storage::disk('public')->exists($pembayaran->bukti_bayar), 404);

        return response()->file(Storage::disk('public')->path($pembayaran->bukti_bayar));
    }

    public function verifyPayment(Request $request, Pembayaran $pembayaran)
    {
        $data = $request->validate(['status_bayar' => 'required|in:berhasil,gagal']);
        $pembayaran->update($data);

        $pemesanan = $pembayaran->pemesanan;
        if ($data['status_bayar'] === 'berhasil') {
            $pemesanan->update(['status' => 'dibayar']);
            ETiket::firstOrCreate(['id_pemesanan' => $pemesanan->id], ['kode_qr' => 'ETK-'.now()->format('Ymd').'-'.Str::upper(Str::random(8)), 'tanggal_kirim' => now(), 'status_tiket' => $this->ticketStatusFor($pemesanan)]);
        }

        if ($data['status_bayar'] === 'gagal') {
            $pemesanan->update(['status' => 'pending']);
        }

        return back()->with('success', 'Status pembayaran diperbarui.');
    }

    public function updateBookingStatus(Request $request, Pemesanan $pemesanan)
    {
        $data = $request->validate(['status' => 'required|in:pending,dibayar,selesai']);
        $pemesanan->update($data);

        if ($data['status'] === 'dibayar') {
            ETiket::firstOrCreate(
                ['id_pemesanan' => $pemesanan->id],
                ['kode_qr' => 'ETK-'.now()->format('Ymd').'-'.Str::upper(Str::random(8)), 'tanggal_kirim' => now(), 'status_tiket' => $this->ticketStatusFor($pemesanan)]
            );
        }

        if ($data['status'] === 'selesai' && $pemesanan->eTiket && $pemesanan->eTiket->status_tiket !== 'kadaluarsa') {
            $pemesanan->eTiket->update(['status_tiket' => 'digunakan']);
        }

        return back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }

    public function destroyBooking(Pemesanan $pemesanan)
    {
        $pemesanan->load(['detailPemesanans.tiket', 'pembayaran', 'eTiket']);

        if ($pemesanan->pembayaran?->bukti_bayar && Storage::disk('public')->exists($pemesanan->pembayaran->bukti_bayar)) {
            Storage::disk('public')->delete($pemesanan->pembayaran->bukti_bayar);
        }

        if ($pemesanan->status !== 'selesai' && $pemesanan->eTiket?->status_tiket !== 'digunakan') {
            foreach ($pemesanan->detailPemesanans as $detail) {
                $detail->tiket?->increment('stok', $detail->jumlah_tiket);
            }
        }

        $pemesanan->detailPemesanans()->delete();
        $pemesanan->eTiket?->delete();
        $pemesanan->pembayaran?->delete();
        $pemesanan->delete();

        return back()->with('success', 'Data pemesanan berhasil dihapus.');
    }

    public function reports(Request $request)
    {
        $query = Pembayaran::with('pemesanan.tiket', 'pemesanan.user')->where('status_bayar', 'berhasil');
        if ($request->filled('month')) $query->whereMonth('tanggal_bayar', $request->month);
        if ($request->filled('year')) $query->whereYear('tanggal_bayar', $request->year);

        $pembayarans = $query->latest('tanggal_bayar')->get();
        $reportRows = $pembayarans
            ->groupBy(fn ($payment) => optional($payment->tanggal_bayar)->format('Y-m-d') ?? 'unknown')
            ->map(function ($payments, $date) {
                return [
                    'date' => $date,
                    'total_tickets' => $payments->sum(fn ($payment) => optional($payment->pemesanan)->detailPemesanans->sum('jumlah_tiket') ?? 0),
                    'revenue' => $payments->sum('jumlah_bayar'),
                    'items' => $payments->flatMap(fn ($payment) => $payment->pemesanan->detailPemesanans ?? collect())
                        ->groupBy(fn ($detail) => optional($detail->tiket)->nama_tiket ?? 'Tanpa Tiket')
                        ->map(fn ($details) => $details->sum('jumlah_tiket')),
                ];
            })
            ->sortKeysDesc();

        return view('admin.reports', [
            'pembayarans' => $pembayarans,
            'reportRows' => $reportRows,
            'totalRevenue' => $pembayarans->sum('jumlah_bayar'),
            'totalTickets' => $reportRows->sum('total_tickets'),
            'selectedMonth' => $request->input('month', now()->month),
            'selectedYear' => $request->input('year', now()->year),
        ]);
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

    private function ticketStatusFor(Pemesanan $pemesanan): string
    {
        return $this->isVisitDateExpired($pemesanan) ? 'kadaluarsa' : 'aktif';
    }

    private function isVisitDateExpired(Pemesanan $pemesanan): bool
    {
        $validUntil = $pemesanan->tanggal_berakhir ?? $pemesanan->tanggal_kunjungan;

        return $validUntil !== null && $validUntil->lt(today());
    }
}
