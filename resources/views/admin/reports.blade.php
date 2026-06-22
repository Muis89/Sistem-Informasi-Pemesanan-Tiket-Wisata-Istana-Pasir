@extends('layouts.dashboard')

@section('dashboard-title', 'Laporan Omzet & Analisis')

@section('dashboard-content')
<div class="mb-8"><h2 class="text-xl font-bold text-slate-900">Laporan Pendapatan & Penjualan Tiket</h2><p class="text-xs text-slate-500">Filter berdasarkan bulan/tahun untuk melihat analisis revenue wisata</p></div>
<form method="GET" class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm mb-8 flex flex-col sm:flex-row items-end gap-4 print:hidden">
    <div class="flex-grow space-y-1"><label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Bulan</label><select name="month" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm bg-slate-50/50">@foreach(range(1,12) as $m)<option value="{{ $m }}" @selected((int)$selectedMonth === $m)>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>@endforeach</select></div>
    <div class="flex-grow space-y-1"><label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Tahun</label><select name="year" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm bg-slate-50/50">@foreach(range(now()->year, now()->year-5) as $y)<option value="{{ $y }}" @selected((int)$selectedYear === $y)>{{ $y }}</option>@endforeach</select></div>
    <button class="px-6 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-xl text-sm font-bold shadow-md">🔍 Tampilkan</button>
    <button type="button" onclick="window.print()" class="px-6 py-3 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-md">📥 Cetak</button>
</form>
<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden"><div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50"><h3 class="text-base font-bold text-slate-900">Rekap Penjualan Tiket — {{ \Carbon\Carbon::create((int)$selectedYear, (int)$selectedMonth)->translatedFormat('F Y') }}</h3></div><div class="overflow-x-auto"><table class="w-full text-left text-sm border-collapse"><thead><tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-wider border-b border-slate-100"><th class="py-4 px-6">Tanggal</th><th class="py-4 px-6">Rincian Tiket</th><th class="py-4 px-6">Total Tiket</th><th class="py-4 px-6">Revenue Harian</th></tr></thead><tbody class="divide-y divide-slate-100 text-slate-700 font-semibold">
@forelse($reportRows as $row)
<tr><td class="py-3 px-6">{{ \Carbon\Carbon::parse($row['date'])->format('d M Y') }}</td><td class="py-3 px-6">@foreach($row['items'] as $name=>$qty)<span class="inline-flex mr-2 mb-1 px-2 py-0.5 bg-amber-50 text-amber-700 rounded-lg text-xs">{{ $name }}: {{ $qty }}</span>@endforeach</td><td class="py-3 px-6 font-bold">{{ $row['total_tickets'] }}</td><td class="py-3 px-6 font-bold text-emerald-700">Rp {{ number_format($row['revenue'], 0, ',', '.') }}</td></tr>
@empty
<tr><td colspan="4" class="py-12 px-6 text-center text-slate-500">Tidak ada data pembayaran berhasil pada periode ini.</td></tr>
@endforelse
<tr class="bg-amber-50/50 border-t-2 border-amber-200"><td class="py-4 px-6 font-extrabold text-slate-900" colspan="2">TOTAL PERIODE</td><td class="py-4 px-6 font-extrabold text-slate-900">{{ $totalTickets }}</td><td class="py-4 px-6 font-extrabold text-amber-700 text-base">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td></tr>
</tbody></table></div></div>
@endsection
