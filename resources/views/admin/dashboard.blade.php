@extends('layouts.dashboard')

@section('dashboard-title', 'Overview Dashboard')

@section('dashboard-content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm flex items-center justify-between"><div class="space-y-1"><span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pengunjung</span><span class="block text-2xl font-black text-slate-900">{{ number_format($totalVisitors) }}</span><span class="inline-flex items-center gap-1 text-[10px] text-emerald-600 font-bold">📈 Akumulasi tiket terjual</span></div><span class="p-4 bg-amber-50 text-amber-600 rounded-2xl text-2xl shadow-inner">👥</span></div>
    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm flex items-center justify-between"><div class="space-y-1"><span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Pemesanan Tiket</span><span class="block text-2xl font-black text-slate-900">{{ number_format($totalBookings) }}</span><span class="inline-flex items-center gap-1 text-[10px] text-sky-600 font-bold">🎟️ Semua transaksi</span></div><span class="p-4 bg-sky-50 text-sky-600 rounded-2xl text-2xl shadow-inner">🎟️</span></div>
    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm flex items-center justify-between"><div class="space-y-1"><span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Pembayaran Berhasil</span><span class="block text-2xl font-black text-slate-900">{{ number_format($totalPayments) }}</span><span class="inline-flex items-center gap-1 text-[10px] text-amber-600 font-bold">⏳ {{ $pendingPayments }} menunggu</span></div><span class="p-4 bg-yellow-50 text-yellow-600 rounded-2xl text-2xl shadow-inner">💳</span></div>
    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm flex items-center justify-between"><div class="space-y-1"><span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Total Omzet</span><span class="block text-2xl font-black text-slate-900">Rp {{ number_format($revenue,0,',','.') }}</span><span class="inline-flex items-center gap-1 text-[10px] text-emerald-600 font-bold">💰 Terverifikasi</span></div><span class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl text-2xl shadow-inner">💰</span></div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50"><div><h3 class="text-base font-bold text-slate-900">Pemesanan Tiket Terbaru</h3><p class="text-xs text-slate-400">Log transaksi real-time pengunjung</p></div><a href="{{ route('admin.bookings') }}" class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-bold transition-all">Lihat Semua</a></div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead><tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-wider border-b border-slate-100"><th class="py-4 px-6">ID Booking</th><th class="py-4 px-6">Pengunjung</th><th class="py-4 px-6">Tiket</th><th class="py-4 px-6">Jumlah</th><th class="py-4 px-6">Total Bayar</th><th class="py-4 px-6">Status</th></tr></thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-semibold">
                    @forelse($recentBookings as $booking)
                        @php
                            $status = optional($booking->pembayaran)->status_bayar;
                            $badge = $booking->status === 'selesai' ? 'bg-slate-100 text-slate-700' : ($status === 'berhasil' || $booking->status === 'dibayar' ? 'bg-emerald-100 text-emerald-800' : ($status === 'gagal' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800'));
                            $label = $booking->status === 'selesai' ? 'Selesai' : ($status === 'berhasil' || $booking->status === 'dibayar' ? 'Paid' : ($status === 'gagal' ? 'Ditolak' : 'Pending'));
                        @endphp
                        <tr><td class="py-4 px-6 text-slate-900 font-bold">#IP-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</td><td class="py-4 px-6">{{ $booking->user->name }}</td><td class="py-4 px-6"><span class="px-2 py-0.5 bg-amber-50 text-amber-700 rounded-lg text-xs font-bold">{{ $booking->tiket->nama_tiket }}</span></td><td class="py-4 px-6">{{ $booking->jumlah_tiket }} Pcs</td><td class="py-4 px-6 font-bold text-slate-950">Rp {{ number_format($booking->total_harga,0,',','.') }}</td><td class="py-4 px-6"><span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $badge }}">{{ $label }}</span></td></tr>
                    @empty
                        <tr><td colspan="6" class="py-12 px-6 text-center text-slate-500">Belum ada transaksi pemesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 space-y-6">
        <h3 class="text-base font-bold text-slate-900">Kapasitas Tiket Hari Ini</h3>
        <div class="space-y-4">
            @forelse($tikets as $ticket)
                @php $percent = min(100, max(8, 100 - min(100, $ticket->stok / 5))); @endphp
                <div class="space-y-1.5"><div class="flex justify-between text-xs font-semibold text-slate-600"><span>{{ $ticket->nama_tiket }}</span><span>{{ $ticket->stok }} stok</span></div><div class="h-2 bg-slate-100 rounded-full overflow-hidden"><div class="h-full {{ $ticket->stok < 50 ? 'bg-rose-500' : ($ticket->stok < 150 ? 'bg-amber-500' : 'bg-sky-500') }} rounded-full" style="width: {{ $percent }}%"></div></div></div>
            @empty
                <p class="text-sm text-slate-500">Belum ada data tiket.</p>
            @endforelse
        </div>
        <div class="pt-4 border-t border-slate-100"><span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Pemberitahuan Sistem</span><div class="p-3.5 bg-amber-50 border border-amber-100 rounded-xl text-xs text-amber-800 leading-relaxed font-semibold">⚠️ Ada {{ $pendingPayments }} upload pembayaran manual yang perlu diverifikasi.</div></div>
    </div>
</div>
@endsection
