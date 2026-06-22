@extends('layouts.dashboard')

@section('dashboard-title', 'Verifikasi Pembayaran')

@section('dashboard-content')
<div x-data="{ detailModal: false, selected: {} }">
    <div class="mb-8"><h2 class="text-xl font-bold text-slate-900">Verifikasi Bukti Pembayaran Manual</h2><p class="text-xs text-slate-500">Kelola dan verifikasi upload bukti transfer dari pengunjung</p></div>
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden"><div class="overflow-x-auto"><table class="w-full text-left text-sm border-collapse">
        <thead><tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-wider border-b border-slate-100"><th class="py-4 px-6">ID Booking</th><th class="py-4 px-6">Pengunjung</th><th class="py-4 px-6">Bukti</th><th class="py-4 px-6">Total Transfer</th><th class="py-4 px-6">Tgl Upload</th><th class="py-4 px-6">Status</th><th class="py-4 px-6 text-right">Aksi</th></tr></thead>
        <tbody class="divide-y divide-slate-100 text-slate-700 font-semibold">
            @forelse($pembayarans as $pembayaran)
                @php
                    $statusClass = $pembayaran->status_bayar === 'berhasil' ? 'bg-emerald-100 text-emerald-800' : ($pembayaran->status_bayar === 'gagal' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800');
                    $statusLabel = $pembayaran->status_bayar === 'berhasil' ? '✅ Disetujui' : ($pembayaran->status_bayar === 'gagal' ? '❌ Ditolak' : '⏳ Menunggu');
                    $proofUrl = $pembayaran->bukti_bayar ? route('admin.payments.proof', $pembayaran) : '';
                @endphp
                <tr>
                    <td class="py-4 px-6 font-bold text-slate-900">#IP-{{ str_pad($pembayaran->id_pemesanan, 6, '0', STR_PAD_LEFT) }}</td>
                    <td class="py-4 px-6">{{ $pembayaran->pemesanan->user->name }}</td>
                    <td class="py-4 px-6">
                        @if($proofUrl)
                            <button type="button" @click="selected = { id: '{{ $pembayaran->id }}', booking: '#IP-{{ str_pad($pembayaran->id_pemesanan, 6, '0', STR_PAD_LEFT) }}', name: @js($pembayaran->pemesanan->user->name), total: 'Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}', proof: '{{ $proofUrl }}' }; detailModal = true" class="block w-16 h-16 rounded-xl overflow-hidden border border-slate-200 bg-slate-50 shadow-sm hover:ring-2 hover:ring-sky-400 transition-all">
                                <img src="{{ $proofUrl }}" class="w-full h-full object-cover" alt="Bukti Transfer">
                            </button>
                        @else
                            <span class="text-xs text-slate-400">Tidak ada</span>
                        @endif
                    </td>
                    <td class="py-4 px-6 font-bold">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                    <td class="py-4 px-6 text-xs">{{ optional($pembayaran->tanggal_bayar)->format('d M Y, H:i') }}</td>
                    <td class="py-4 px-6"><span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $statusClass }}">{{ $statusLabel }}</span></td>
                    <td class="py-4 px-6 text-right"><button @click="selected = { id: '{{ $pembayaran->id }}', booking: '#IP-{{ str_pad($pembayaran->id_pemesanan, 6, '0', STR_PAD_LEFT) }}', name: @js($pembayaran->pemesanan->user->name), total: 'Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}', proof: '{{ $proofUrl }}' }; detailModal = true" class="px-3.5 py-1.5 bg-sky-500 hover:bg-sky-600 text-white rounded-lg text-xs font-bold shadow-sm transition-all">🔍 Kelola/Detail</button></td>
                </tr>
            @empty
                <tr><td colspan="7" class="py-12 px-6 text-center text-slate-500">Belum ada bukti pembayaran.</td></tr>
            @endforelse
        </tbody>
    </table></div></div>

    <div class="fixed inset-0 bg-slate-900/65 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-show="detailModal" style="display: none;">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl border border-slate-100" @click.away="detailModal = false">
            <h3 class="text-lg font-bold text-slate-900">Detail Bukti Pembayaran</h3>
            <div class="space-y-4 text-sm"><div class="flex justify-between"><span class="text-slate-500">ID Booking</span><span class="font-bold" x-text="selected.booking"></span></div><div class="flex justify-between"><span class="text-slate-500">Pengunjung</span><span class="font-bold" x-text="selected.name"></span></div><div class="flex justify-between"><span class="text-slate-500">Total</span><span class="font-bold text-amber-600" x-text="selected.total"></span></div></div>
            <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl text-center"><template x-if="selected.proof"><img :src="selected.proof" class="w-full max-h-80 object-contain rounded-xl border border-slate-100" alt="Bukti Transfer"></template><template x-if="!selected.proof"><div class="w-full h-48 bg-slate-200 rounded-xl flex items-center justify-center text-slate-400 text-sm font-bold">📄 Bukti tidak tersedia</div></template></div>
            <div class="flex gap-3"><template x-if="selected.id"><form :action="'{{ url('/admin/payments') }}/' + selected.id" method="POST" class="flex-grow">@csrf @method('PATCH')<input type="hidden" name="status_bayar" value="gagal"><button class="w-full py-3 px-4 bg-rose-100 hover:bg-rose-200 text-rose-700 rounded-xl text-sm font-bold">❌ Tolak Pembayaran</button></form></template><template x-if="selected.id"><form :action="'{{ url('/admin/payments') }}/' + selected.id" method="POST" class="flex-grow">@csrf @method('PATCH')<input type="hidden" name="status_bayar" value="berhasil"><button class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold">✅ Setujui Pembayaran</button></form></template></div>
        </div>
    </div>
</div>
@endsection
