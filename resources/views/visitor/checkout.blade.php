@extends('layouts.visitor')

@section('title', 'Simulasi Pembayaran Tiket')

@section('visitor-content')
@php
    $validUntil = $pemesanan->tanggal_berakhir ?? $pemesanan->tanggal_kunjungan;
    $visitExpired = $validUntil && $validUntil->lt(today());
@endphp
<div class="max-w-4xl mx-auto">
    <div class="mb-8 space-y-2">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Checkout & Simulasi Pembayaran</h2>
        <p class="text-sm text-slate-500">Selesaikan transfer manual dan unggah bukti pembayaran.</p>
    </div>

    @if ($errors->any())<div class="mb-4 p-4 rounded-2xl bg-rose-50 text-rose-700 text-sm font-bold">{{ $errors->first() }}</div>@endif
    @if (session('success'))<div class="mb-4 p-4 rounded-2xl bg-emerald-50 text-emerald-700 text-sm font-bold">{{ session('success') }}</div>@endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6">
                <h3 class="text-lg font-bold text-slate-900 pb-4 border-b border-slate-150 flex items-center gap-2">🏦 <span>Informasi Rekening Tujuan</span></h3>
                <p class="text-xs text-slate-500 leading-relaxed">Transfer sesuai nominal total pembayaran ke rekening resmi berikut:</p>
                <div class="space-y-4">
                    <div class="p-4 bg-slate-50 border border-slate-150 rounded-2xl flex items-center justify-between"><div class="space-y-1"><span class="inline-block px-2.5 py-0.5 rounded-lg bg-sky-50 text-sky-700 font-extrabold text-[10px]">BANK MANDIRI</span><span class="block font-bold text-sm text-slate-900 tracking-wider">163-00-0123456-7</span><span class="block text-xs text-slate-500">a.n PT Istana Pasir Wisata</span></div><button type="button" class="px-3 py-1.5 bg-white border border-slate-200 text-slate-700 text-xs font-bold rounded-lg" onclick="navigator.clipboard.writeText('1630001234567'); alert('Nomor Rekening disalin!')">Salin 📋</button></div>
                    <div class="p-4 bg-slate-50 border border-slate-150 rounded-2xl flex items-center justify-between"><div class="space-y-1"><span class="inline-block px-2.5 py-0.5 rounded-lg bg-blue-50 text-blue-700 font-extrabold text-[10px]">BANK BCA</span><span class="block font-bold text-sm text-slate-900 tracking-wider">245-6789-012</span><span class="block text-xs text-slate-500">a.n PT Istana Pasir Wisata</span></div><button type="button" class="px-3 py-1.5 bg-white border border-slate-200 text-slate-700 text-xs font-bold rounded-lg" onclick="navigator.clipboard.writeText('2456789012'); alert('Nomor Rekening disalin!')">Salin 📋</button></div>
                </div>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6">
                <h3 class="text-lg font-bold text-slate-900 pb-4 border-b border-slate-150 flex items-center gap-2">📸 <span>Konfirmasi Unggah Bukti</span></h3>
                @if($visitExpired)
                    <div class="p-4 bg-rose-50 border border-rose-100 text-rose-700 rounded-2xl text-sm font-bold">Tanggal kunjungan sudah lewat. Pemesanan ini tidak bisa dibayar. Silakan buat pemesanan baru.</div>
                @else
                <form action="{{ route('visitor.payment.upload', $pemesanan) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="space-y-2"><label for="bukti_bayar" class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Unggah Foto / Screenshot Struk Transfer</label><div class="border-2 border-dashed border-slate-250 hover:border-amber-400 rounded-2xl p-6 text-center bg-slate-50/50 relative group cursor-pointer"><input type="file" name="bukti_bayar" id="bukti_bayar" required accept="image/png,image/jpeg" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)"><div class="space-y-3" id="upload-placeholder"><span class="text-4xl block">📄</span><div><span class="block font-bold text-sm text-slate-700">Pilih file atau seret ke sini</span><span class="block text-xs text-slate-400 mt-1">JPG/PNG maksimal 2MB</span></div></div><div class="hidden space-y-2" id="preview-container"><img id="preview-img" src="#" alt="Bukti Pembayaran" class="max-h-40 mx-auto rounded-lg shadow-md border border-slate-200"><span class="block text-xs font-bold text-emerald-600">✓ File siap diunggah!</span></div></div></div>
                    <button type="submit" class="w-full py-3.5 px-6 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl text-sm font-bold shadow-md shadow-amber-500/20">📤 Kirim Bukti Pembayaran</button>
                </form>
                @endif
            </div>
        </div>

        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-6">
                <h3 class="text-lg font-bold text-slate-900 pb-4 border-b border-slate-150">Rincian Pembayaran</h3>
                <div class="space-y-4 text-sm font-medium">
                    <div class="flex justify-between text-slate-500"><span>ID Booking</span><span class="text-slate-900 font-bold">#IP-{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</span></div>
                    <div class="flex justify-between text-slate-500"><span>Tiket Dipesan</span><span class="text-slate-900 font-bold text-right">{{ $pemesanan->tiket->nama_tiket }} ({{ $pemesanan->jumlah_tiket }}x)</span></div>
                    <div class="flex justify-between text-slate-500"><span>Periode Wisata</span><span class="text-slate-900 font-bold text-right">{{ optional($pemesanan->tanggal_kunjungan)->format('d M Y') }} - {{ optional($validUntil)->format('d M Y') }}</span></div>
                    <div class="flex justify-between text-slate-500"><span>Status Pembayaran</span><span class="font-bold {{ $pemesanan->pembayaran ? 'text-amber-600' : 'text-slate-900' }}">{{ $pemesanan->pembayaran ? ucfirst($pemesanan->pembayaran->status_bayar) : 'Belum Upload' }}</span></div>
                    <div class="border-t border-slate-100 pt-4 flex justify-between items-end"><span class="block text-xs text-slate-400 font-bold uppercase tracking-wider">Total Pembayaran</span><span class="text-2xl font-extrabold text-rose-600">Rp {{ number_format($pemesanan->total_harga,0,',','.') }}</span></div>
                </div>
                <div class="p-4 bg-amber-50 border border-amber-200 text-amber-800 rounded-2xl flex gap-3 text-xs leading-relaxed"><span class="text-lg">⚠️</span><p class="font-semibold">Pastikan nominal transfer sesuai. Admin akan memverifikasi bukti pembayaran.</p></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')<script>function previewImage(input){const file=input.files[0];if(file){const reader=new FileReader();reader.onload=e=>{document.getElementById('upload-placeholder').classList.add('hidden');document.getElementById('preview-container').classList.remove('hidden');document.getElementById('preview-img').src=e.target.result};reader.readAsDataURL(file);}}</script>@endsection
