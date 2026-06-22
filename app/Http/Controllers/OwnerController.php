<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Tiket;
use Illuminate\Support\Carbon;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $successfulPayments = Pembayaran::where('status_bayar', 'berhasil');
        $year = now()->year;

        $monthlyRevenue = collect(range(1, 12))->map(function ($month) use ($year) {
            return Pembayaran::where('status_bayar', 'berhasil')
                ->whereMonth('tanggal_bayar', $month)
                ->whereYear('tanggal_bayar', $year)
                ->sum('jumlah_bayar');
        });

        $dailyVisitors = collect(range(6, 0))->map(function ($offset) {
            $date = today()->subDays($offset);
            return [
                'label' => $date->format('d M'),
                'value' => Pemesanan::whereDate('tanggal_kunjungan', $date)->sum('jumlah_tiket'),
            ];
        });

        $ticketPerformance = Tiket::withSum(['pemesanans as sold_count' => function ($query) {
            $query->whereIn('status', ['dibayar', 'selesai']);
        }], 'jumlah_tiket')->latest()->get();

        return view('owner.dashboard', [
            'dailyRevenue' => (clone $successfulPayments)->whereDate('tanggal_bayar', today())->sum('jumlah_bayar'),
            'monthlyRevenue' => (clone $successfulPayments)->whereMonth('tanggal_bayar', now()->month)->whereYear('tanggal_bayar', now()->year)->sum('jumlah_bayar'),
            'yearlyRevenue' => (clone $successfulPayments)->whereYear('tanggal_bayar', now()->year)->sum('jumlah_bayar'),
            'totalVisitors' => Pemesanan::where('status', 'selesai')->sum('jumlah_tiket'),
            'totalBookings' => Pemesanan::count(),
            'pendingPayments' => Pembayaran::where('status_bayar', 'pending')->count(),
            'tickets' => Tiket::latest()->get(),
            'recentPayments' => Pembayaran::with('pemesanan.user', 'pemesanan.tiket')->latest()->take(6)->get(),
            'chartMonths' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'chartRevenue' => $monthlyRevenue,
            'dailyVisitors' => $dailyVisitors,
            'ticketPerformance' => $ticketPerformance,
        ]);
    }
}
