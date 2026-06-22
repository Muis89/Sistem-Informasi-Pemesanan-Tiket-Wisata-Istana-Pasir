@extends('layouts.visitor')

@section('title', 'Dashboard Pengunjung')

@section('visitor-content')
@php
    $activeCount = $pemesanans->filter(fn($p) => in_array($p->status, ['pending', 'dibayar']) && optional($p->eTiket)->status_tiket !== 'kadaluarsa')->count();
    $unpaidTotal = $pemesanans->filter(fn($p) => ! $p->pembayaran || $p->pembayaran->status_bayar === 'pending')->sum('total_harga');
    $usedCount = $pemesanans->filter(fn($p) => optional($p->eTiket)->status_tiket === 'digunakan')->sum('jumlah_tiket');
@endphp
@if (session('success'))<div class="mb-6 p-4 rounded-2xl bg-emerald-50 text-emerald-700 text-sm font-bold border border-emerald-100">{{ session('success') }}</div>@endif
@if (session('error'))<div class="mb-6 p-4 rounded-2xl bg-rose-50 text-rose-700 text-sm font-bold border border-rose-100">{{ session('error') }}</div>@endif
<div class="bg-gradient-to-r from-amber-500 to-sky-500 rounded-3xl p-6 sm:p-8 text-white shadow-lg shadow-amber-500/10 mb-8 relative overflow-hidden">
    <div class="absolute -right-10 -bottom-10 w-40 h-40 rounded-full bg-white/10"></div><div class="absolute right-20 -top-10 w-24 h-24 rounded-full bg-white/10"></div>
    <div class="max-w-2xl space-y-3 relative z-10">
        <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold tracking-wider uppercase">👋 Selamat Datang</span>
        <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight">Halo, {{ auth()->user()->name }}!</h2>
        <p class="text-sm sm:text-base text-slate-100 leading-relaxed">Pantau status pembayaran, pesan tiket baru, dan akses e-ticket Anda dari dashboard pengunjung Istana Pasir Cilegon.</p>
        <div class="pt-2"><a href="{{ route('visitor.book') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-slate-900 rounded-xl font-bold text-sm shadow-md hover:bg-slate-50 transition-all">🎟️ Beli Tiket Baru Sekarang</a></div>
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4"><span class="p-4 bg-amber-50 text-amber-600 rounded-xl text-2xl">📅</span><div><span class="block text-2xl font-bold text-slate-900">{{ $activeCount }}</span><span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider">Pemesanan Aktif</span></div></div>
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4"><span class="p-4 bg-sky-50 text-sky-600 rounded-xl text-2xl">💳</span><div><span class="block text-2xl font-bold text-slate-900">Rp {{ number_format($unpaidTotal,0,',','.') }}</span><span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider">Perlu Diproses</span></div></div>
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4"><span class="p-4 bg-emerald-50 text-emerald-600 rounded-xl text-2xl">🎫</span><div><span class="block text-2xl font-bold text-slate-900">{{ $usedCount }}</span><span class="block text-xs text-slate-400 font-semibold uppercase tracking-wider">Tiket Digunakan</span></div></div>
</div>
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4"><div><h3 class="text-lg font-bold text-slate-900">Riwayat & Status Tiket Saya</h3><p class="text-xs text-slate-500">Pantau status pembayaran dan akses e-tiket Anda.</p></div><span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 text-xs font-bold rounded-lg border border-amber-200">📌 {{ $pemesanans->count() }} Transaksi</span></div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
            <thead><tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-wider border-b border-slate-100"><th class="py-4 px-6">ID Booking</th><th class="py-4 px-6">Tanggal Kunjungan</th><th class="py-4 px-6">Kategori Tiket</th><th class="py-4 px-6">Jumlah</th><th class="py-4 px-6">Total Harga</th><th class="py-4 px-6">Status</th><th class="py-4 px-6 text-right">Aksi</th></tr></thead>
            <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                @forelse($pemesanans as $pemesanan)
                @php
                    $paymentStatus = optional($pemesanan->pembayaran)->status_bayar;
                    $ticketStatus = optional($pemesanan->eTiket)->status_tiket;
                    $validUntil = $pemesanan->tanggal_berakhir ?? $pemesanan->tanggal_kunjungan;
                    $visitExpired = $validUntil && $validUntil->lt(today());
                    $label = match (true) {
                        $ticketStatus === 'kadaluarsa' => 'Kadaluarsa',
                        $ticketStatus === 'digunakan' => 'Sudah Digunakan',
                        $ticketStatus === 'aktif' => 'Lunas & Aktif',
                        $visitExpired => 'Tanggal Lewat',
                        $paymentStatus === 'pending' => 'Menunggu Verifikasi',
                        $paymentStatus === 'gagal' => 'Ditolak',
                        default => 'Menunggu Pembayaran',
                    };
                    $badge = match (true) {
                        $ticketStatus === 'kadaluarsa' || $visitExpired || $paymentStatus === 'gagal' => 'bg-rose-100 text-rose-800',
                        $ticketStatus === 'digunakan' => 'bg-slate-100 text-slate-700',
                        $ticketStatus === 'aktif' => 'bg-emerald-100 text-emerald-800',
                        default => 'bg-amber-100 text-amber-800',
                    };
                @endphp
                <tr class="hover:bg-slate-50/50 transition-colors"><td class="py-4 px-6 font-bold text-slate-900">#IP-{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</td><td class="py-4 px-6"><span class="block font-bold">{{ optional($pemesanan->tanggal_kunjungan)->format('d M Y') }} - {{ optional($validUntil)->format('d M Y') }}</span><span class="text-[10px] {{ $visitExpired ? 'text-rose-500' : 'text-slate-400' }}">{{ $visitExpired ? 'Periode berakhir' : 'Periode aktif dipilih user' }}</span></td><td class="py-4 px-6"><span class="inline-flex px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 font-bold text-xs">{{ $pemesanan->tiket->nama_tiket }}</span></td><td class="py-4 px-6">{{ $pemesanan->jumlah_tiket }} Tiket</td><td class="py-4 px-6 font-extrabold text-slate-950">Rp {{ number_format($pemesanan->total_harga,0,',','.') }}</td><td class="py-4 px-6"><span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold {{ $badge }}">{{ $label }}</span></td><td class="py-4 px-6 text-right"><div class="flex justify-end gap-2">@if($pemesanan->eTiket)<a href="{{ route('visitor.ticket', $pemesanan) }}" class="px-3.5 py-1.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg text-xs font-bold shadow-sm transition-all">🎫 Lihat E-Tiket</a>@elseif($visitExpired)<span class="px-3.5 py-1.5 bg-slate-100 text-slate-500 rounded-lg text-xs font-bold">Tidak Bisa Dibayar</span>@else<a href="{{ route('visitor.checkout', $pemesanan) }}" class="px-3.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-lg text-xs font-bold shadow-sm transition-all">💳 Bayar / Upload</a>@endif</div></td></tr>
                @empty
                <tr><td colspan="7" class="py-12 px-6 text-center"><div class="space-y-3"><span class="text-5xl block">🏖️</span><p class="font-bold text-slate-700">Belum ada pemesanan.</p><a href="{{ route('visitor.book') }}" class="inline-flex px-4 py-2 bg-amber-500 text-white rounded-xl text-sm font-bold">Pesan tiket pertama</a></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
