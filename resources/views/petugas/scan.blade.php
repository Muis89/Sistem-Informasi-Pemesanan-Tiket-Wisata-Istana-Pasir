@extends('layouts.dashboard')

@section('dashboard-title', 'Verifikasi E-Tiket')

@section('dashboard-content')
<div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-8">
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm"><p class="text-xs text-slate-500 font-bold uppercase">Tiket Aktif</p><p class="text-2xl font-black text-emerald-600">{{ $activeTickets }}</p></div>
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm"><p class="text-xs text-slate-500 font-bold uppercase">Sudah Digunakan</p><p class="text-2xl font-black text-slate-700">{{ $usedTickets }}</p></div>
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm"><p class="text-xs text-slate-500 font-bold uppercase">Kunjungan Hari Ini</p><p class="text-2xl font-black text-amber-600">{{ $todayBookings }}</p></div>
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm"><p class="text-xs text-slate-500 font-bold uppercase">Payment Pending</p><p class="text-2xl font-black text-rose-600">{{ $pendingPayments }}</p></div>
</div>
<div id="scan" class="bg-white rounded-3xl border border-slate-200/60 shadow-sm p-6 sm:p-8 max-w-2xl">
    <h2 class="text-xl font-bold text-slate-900 mb-2">Scan / Input Kode QR</h2><p class="text-xs text-slate-500 mb-6">Masukkan kode QR dari e-ticket pengunjung untuk mengubah status menjadi digunakan.</p>
    <form action="{{ route('petugas.verify') }}" method="POST" class="space-y-4">@csrf
        <input name="kode_qr" required placeholder="Contoh: ETK-20260616-ABCDEFGH" class="w-full px-4 py-4 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 font-mono text-sm uppercase">
        <button class="w-full py-4 rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-bold shadow-md">✅ Validasi Tiket Masuk</button>
    </form>
    @if(session('verifiedTicket'))
        @php $ticket = session('verifiedTicket'); @endphp
        <div id="riwayat" class="mt-6 p-5 rounded-2xl bg-emerald-50 border border-emerald-100 text-sm"><p class="font-black text-emerald-800 mb-2">Tiket berhasil divalidasi</p><p>Pengunjung: <b>{{ $ticket->pemesanan->user->name }}</b></p><p>Tiket: <b>{{ $ticket->pemesanan->tiket->nama_tiket }}</b> — {{ $ticket->pemesanan->jumlah_tiket }} orang</p><p>Kode: <b>{{ $ticket->kode_qr }}</b></p></div>
    @endif
</div>
@endsection
