@extends('layouts.visitor')

@section('title', 'E-Tiket Saya')

@section('visitor-content')
@php
    $ticketStatus = $pemesanan->eTiket->status_tiket;
    $validUntil = $pemesanan->tanggal_berakhir ?? $pemesanan->tanggal_kunjungan;
    $statusBadge = match ($ticketStatus) {
        'digunakan' => 'bg-slate-100 text-slate-700',
        'kadaluarsa' => 'bg-rose-100 text-rose-800',
        default => 'bg-emerald-100 text-emerald-800',
    };
    $statusLabel = match ($ticketStatus) {
        'digunakan' => '⚫ Digunakan',
        'kadaluarsa' => '🔴 Kadaluarsa',
        default => '🟢 Lunas & Aktif',
    };
@endphp
<div class="max-w-2xl mx-auto space-y-6">
    <div class="mb-8 text-center space-y-2"><h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">E-Tiket Wisata Resmi</h2><p class="text-sm text-slate-500">Tunjukkan QR Code di bawah ini ke petugas pintu masuk loket Istana Pasir.</p></div>
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden relative">
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-6 h-12 bg-slate-50 rounded-r-full border-y border-r border-slate-100 -ml-0.5"></div><div class="absolute right-0 top-1/2 -translate-y-1/2 w-6 h-12 bg-slate-50 rounded-l-full border-y border-l border-slate-100 -mr-0.5"></div>
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 p-6 sm:p-8 text-slate-950 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4"><div class="space-y-1"><span class="inline-flex px-2.5 py-0.5 bg-white/30 backdrop-blur-md rounded-full text-[10px] font-extrabold tracking-wider uppercase">🏰 VOUCHER MASUK</span><h3 class="text-xl sm:text-2xl font-black tracking-tight text-white">Istana Pasir Cilegon</h3><p class="text-xs text-amber-50 font-medium">Jl. Istana Pasir No. 12, Cibeber, Cilegon</p></div><div class="text-right"><span class="block text-xs font-bold text-amber-100 uppercase tracking-wider">Status Tiket</span><span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $statusBadge }} rounded-full font-bold text-xs mt-1">{{ $statusLabel }}</span></div></div>
        <div class="p-6 sm:p-8 grid grid-cols-1 sm:grid-cols-2 gap-8 items-center"><div class="space-y-5"><div class="grid grid-cols-2 gap-4"><div><span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">Nama Pengunjung</span><span class="font-bold text-sm text-slate-900">{{ $pemesanan->user->name }}</span></div><div><span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">ID Booking</span><span class="font-bold text-sm text-amber-600 tracking-wider">#IP-{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</span></div></div><div class="grid grid-cols-2 gap-4">
            <div><span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">Jenis Tiket</span>
                @foreach($pemesanan->detailPemesanans as $detail)
                    <span class="font-bold text-sm text-slate-900 block">{{ $detail->tiket->nama_tiket }} ({{ $detail->jumlah_tiket }}x)</span>
                @endforeach
            </div>
            <div><span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total Tiket</span><span class="font-bold text-sm text-slate-900 block">{{ $pemesanan->detailPemesanans->sum('jumlah_tiket') }} Tiket</span></div></div><div class="grid grid-cols-2 gap-4 border-t border-slate-100 pt-4"><div><span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">Mulai Kunjungan</span><span class="font-bold text-sm text-slate-900">{{ optional($pemesanan->tanggal_kunjungan)->format('d M Y') }}</span></div><div><span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">Berlaku Sampai</span><span class="font-bold text-sm text-slate-900">{{ optional($validUntil)->format('d M Y') }}</span></div></div><div><span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">Waktu Masuk</span><span class="font-bold text-xs text-slate-900">08:00 - 17:00 WIB</span></div></div><div class="flex flex-col items-center justify-center sm:border-l sm:border-dashed sm:border-slate-200 sm:pl-8"><div class="p-3 bg-slate-50 border border-slate-150 rounded-2xl relative shadow-inner"><svg class="w-36 h-36 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M3 3h6v6H3V3zm2 2v2h2V5H5zm8-2h6v6h-6V3zm2 2v2h2V5h-2zM3 15h6v6H3v-6zm2 2v2h2v-2H5zm13-2h3v3h-3v-3zm0 5h3v3h-3v-3zM11 3h1v3h-1V3zm2 5h2v2h-2V8zm-2 5h2v2h-2v-2zm5-2h2v2h-2v-2zm-3 7h2v2h-2v-2zm-2-3h2v2h-2v-2zm5 2h2v2h-2v-2zm2-5h2v2h-2v-2zM9 11v1H8v-1h1zm4-3v1h-1V8h1zm-5 5v1H7v-1h1zm5 5v1h-1v-1h1z" /></svg><div class="absolute inset-0 m-auto w-8 h-8 bg-white rounded-lg border border-slate-200 shadow flex items-center justify-center text-xs">🏰</div></div><span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-3">{{ $pemesanan->eTiket->kode_qr }}</span></div></div>
        <div class="border-t-2 border-dashed border-slate-200 my-1 mx-8"></div><div class="p-6 bg-slate-50 text-xs text-slate-500 leading-relaxed space-y-2">@if($ticketStatus === 'kadaluarsa')<div class="mb-3 p-3 rounded-xl bg-rose-50 text-rose-700 border border-rose-100 font-bold">Tiket sudah kadaluarsa karena periode kunjungan sudah lewat. Tiket ini tidak dapat digunakan untuk masuk.</div>@endif<p class="font-bold text-slate-700">⚠️ Syarat & Ketentuan Masuk:</p><ul class="list-disc pl-4 space-y-1"><li>E-tiket sah digunakan sebagai akses pintu masuk utama hanya saat status aktif.</li><li>Dilarang membawa makanan berat dari luar area tempat wisata.</li><li>Tiket hanya berlaku sesuai periode tanggal yang tertera dan tidak dapat di-refund.</li></ul></div>
    </div>
    <div class="flex gap-4"><button type="button" class="flex-grow py-3.5 px-6 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-2xl text-sm font-bold shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2" onclick="window.print()">📥 Cetak / Simpan PDF</button><a href="{{ route('visitor.dashboard') }}" class="py-3.5 px-6 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 rounded-2xl text-sm font-bold shadow-sm transition-all text-center">Kembali</a></div>
</div>
@endsection
