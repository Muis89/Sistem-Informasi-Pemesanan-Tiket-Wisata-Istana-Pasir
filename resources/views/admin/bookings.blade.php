@extends('layouts.dashboard')

@section('dashboard-title', 'Data Pemesanan')

@section('dashboard-content')
<div class="mb-8">
    <h2 class="text-xl font-bold text-slate-900">Log Transaksi Pemesanan Tiket</h2>
    <p class="text-xs text-slate-500">Seluruh data pemesanan pengunjung wisata Istana Pasir Cilegon</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <a href="{{ route('admin.bookings', ['status_tiket' => 'aktif']) }}" class="bg-white p-5 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition-all">
        <p class="text-xs text-slate-500 font-bold uppercase">E-Tiket Aktif</p>
        <p class="text-2xl font-black text-emerald-600">{{ $totalAktif }}</p>
    </a>
    <a href="{{ route('admin.bookings', ['status_tiket' => 'digunakan']) }}" class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all">
        <p class="text-xs text-slate-500 font-bold uppercase">Sudah Digunakan</p>
        <p class="text-2xl font-black text-slate-700">{{ $totalDigunakan }}</p>
    </a>
    <a href="{{ route('admin.bookings', ['status_tiket' => 'kadaluarsa']) }}" class="bg-white p-5 rounded-2xl border border-rose-100 shadow-sm hover:shadow-md transition-all">
        <p class="text-xs text-slate-500 font-bold uppercase">E-Tiket Kadaluarsa</p>
        <p class="text-2xl font-black text-rose-600">{{ $totalKadaluarsa }}</p>
    </a>
</div>

<form method="GET" class="bg-white p-4 rounded-2xl border border-slate-200/60 shadow-sm mb-6 flex flex-col sm:flex-row items-end gap-3">
    <div class="flex-grow space-y-1 w-full">
        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Filter Status E-Tiket</label>
        <select name="status_tiket" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm bg-slate-50/50">
            @foreach(['semua'=>'Semua Status','aktif'=>'Aktif','digunakan'=>'Digunakan','kadaluarsa'=>'Kadaluarsa'] as $value=>$text)
                <option value="{{ $value }}" @selected($selectedTicketStatus === $value)>{{ $text }}</option>
            @endforeach
        </select>
    </div>
    <button class="px-6 py-3 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-md">Tampilkan</button>
    <a href="{{ route('admin.bookings') }}" class="px-6 py-3 bg-slate-100 text-slate-700 rounded-xl text-sm font-bold">Reset</a>
</form>

<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-wider border-b border-slate-100">
                    <th class="py-4 px-6">ID Booking</th><th class="py-4 px-6">Nama Pengunjung</th><th class="py-4 px-6">Tiket</th><th class="py-4 px-6">Qty</th><th class="py-4 px-6">Total</th><th class="py-4 px-6">Tgl Kunjungan</th><th class="py-4 px-6">Berlaku Sampai</th><th class="py-4 px-6">Status Pesanan</th><th class="py-4 px-6">Status E-Tiket</th><th class="py-4 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700 font-semibold">
                @forelse($pemesanans as $pemesanan)
                    @php
                        $ticketStatus = optional($pemesanan->eTiket)->status_tiket;
                        $validUntil = $pemesanan->tanggal_berakhir ?? $pemesanan->tanggal_kunjungan;
                        $visitExpired = $validUntil && $validUntil->lt(today());
                        $badge = match (true) {
                            $ticketStatus === 'kadaluarsa' || $visitExpired => 'bg-rose-100 text-rose-800',
                            $ticketStatus === 'digunakan' || $pemesanan->status === 'selesai' => 'bg-slate-100 text-slate-700',
                            $pemesanan->status === 'dibayar' => 'bg-emerald-100 text-emerald-800',
                            default => 'bg-amber-100 text-amber-800',
                        };
                        $label = match (true) {
                            $ticketStatus === 'kadaluarsa' => '🔴 Kadaluarsa',
                            $visitExpired => '🔴 Tanggal Lewat',
                            $ticketStatus === 'digunakan' || $pemesanan->status === 'selesai' => '✅ Selesai',
                            $pemesanan->status === 'dibayar' => '🟢 Dibayar',
                            default => '⏳ Pending',
                        };
                        $ticketBadge = match ($ticketStatus) {
                            'aktif' => 'bg-emerald-100 text-emerald-800',
                            'digunakan' => 'bg-slate-100 text-slate-700',
                            'kadaluarsa' => 'bg-rose-100 text-rose-800',
                            default => 'bg-amber-100 text-amber-800',
                        };
                        $ticketLabel = match ($ticketStatus) {
                            'aktif' => '🟢 Aktif',
                            'digunakan' => '✅ Digunakan',
                            'kadaluarsa' => '🔴 Kadaluarsa',
                            default => 'Belum Ada',
                        };
                    @endphp
                    <tr>
                        <td class="py-4 px-6 font-bold text-slate-900">#IP-{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-4 px-6"><span class="block">{{ $pemesanan->user->name }}</span><span class="text-[10px] text-slate-400">{{ $pemesanan->user->email }}</span></td>
                        <td class="py-4 px-6">
                            @foreach($pemesanan->detailPemesanans as $detail)
                                <span class="px-2 py-0.5 bg-amber-50 text-amber-700 rounded-lg text-xs font-bold mr-1 mb-1 block">{{ $detail->tiket->nama_tiket }}</span>
                            @endforeach
                        </td>
                        <td class="py-4 px-6">{{ $pemesanan->detailPemesanans->sum('jumlah_tiket') }}</td>
                        <td class="py-4 px-6 font-bold">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                        <td class="py-4 px-6"><span class="block font-bold">{{ optional($pemesanan->tanggal_kunjungan)->format('d M Y') }}</span><span class="text-[10px] text-slate-400">Mulai</span></td>
                        <td class="py-4 px-6">
                            <span class="block font-bold {{ $visitExpired ? 'text-rose-700' : 'text-slate-700' }}">{{ optional($validUntil)->format('d M Y') }}</span>
                            <span class="text-[10px] {{ $visitExpired ? 'text-rose-500' : 'text-slate-400' }}">{{ $visitExpired ? 'Sudah berakhir' : 'Tanggal akhir dipilih user' }}</span>
                        </td>
                        <td class="py-4 px-6"><span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $badge }}">{{ $label }}</span></td>
                        <td class="py-4 px-6"><span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $ticketBadge }}">{{ $ticketLabel }}</span></td>
                        <td class="py-4 px-6 text-right">
                            <div class="inline-flex gap-2 items-center">
                            <form action="{{ route('admin.bookings.status', $pemesanan) }}" method="POST" class="inline-flex gap-2 items-center">
                                @csrf @method('PATCH')
                                <select name="status" class="px-2 py-1.5 border border-slate-200 rounded-lg text-xs bg-slate-50">
                                    @foreach(['pending'=>'Pending','dibayar'=>'Dibayar','selesai'=>'Selesai'] as $value=>$text)
                                        <option value="{{ $value }}" @selected($pemesanan->status === $value)>{{ $text }}</option>
                                    @endforeach
                                </select>
                                <button class="px-3 py-1.5 bg-slate-900 text-white rounded-lg text-xs font-bold">Simpan</button>
                            </form>
                            <form action="{{ route('admin.bookings.destroy', $pemesanan) }}" method="POST" onsubmit="return confirm('Yakin hapus data pemesanan ini? Data pembayaran dan e-tiket ikut terhapus.')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white rounded-lg text-xs font-bold">Hapus</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="py-12 px-6 text-center text-slate-500">Belum ada data pemesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
