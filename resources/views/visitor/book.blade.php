@extends('layouts.visitor')

@section('title', 'Pesan Tiket Wisata')

@section('visitor-content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 space-y-2">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Pemesanan Tiket Wisata</h2>
        <p class="text-sm text-slate-500">Pilih tiket tersedia dan total pembayaran akan dihitung otomatis.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 rounded-2xl bg-rose-50 text-rose-700 text-sm font-bold">{{ $errors->first() }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-900 pb-4 border-b border-slate-150">Formulir Tiket</h3>

            <form action="{{ route('visitor.book.store') }}" method="POST" class="space-y-6" id="bookingForm">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Pilih Jenis Tiket</label>
                    <div class="grid grid-cols-1 gap-3">
                        @forelse($tikets as $tiket)
                            <label class="ticket-label relative flex items-center justify-between p-4 bg-white border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all group">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="id_tiket" value="{{ $tiket->id }}" data-price="{{ $tiket->harga }}" data-name="{{ $tiket->nama_tiket }}" required @checked($loop->first) class="h-4.5 w-4.5 text-amber-600 focus:ring-amber-500 border-slate-300" onchange="calculateTotal()">
                                    <div>
                                        <span class="block font-bold text-sm text-slate-900 group-hover:text-amber-600 transition-colors">{{ $tiket->nama_tiket }}</span>
                                        <span class="block text-xs text-slate-400">Stok tersisa: {{ $tiket->stok }} tiket</span>
                                    </div>
                                </div>
                                <span class="font-extrabold text-sm text-slate-900">Rp {{ number_format($tiket->harga, 0, ',', '.') }} <span class="text-[10px] text-slate-400 font-normal">/pcs</span></span>
                            </label>
                        @empty
                            <div class="p-4 bg-amber-50 text-amber-700 rounded-2xl text-sm font-bold">Belum ada tiket tersedia.</div>
                        @endforelse
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="visit_start_date" class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Tanggal Mulai Kunjungan</label>
                        <input id="visit_start_date" name="visit_start_date" type="date" required min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}" class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50" onchange="syncEndDate(); calculateTotal()">
                    </div>
                    <div class="space-y-1.5">
                        <label for="visit_end_date" class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Tanggal Selesai Kunjungan</label>
                        <input id="visit_end_date" name="visit_end_date" type="date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}" class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50" onchange="calculateTotal()">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="quantity" class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Jumlah Tiket</label>
                    <div class="flex items-center gap-3">
                        <button type="button" onclick="adjustQty(-1)" class="w-11 h-11 border border-slate-200 bg-slate-50 hover:bg-slate-100 rounded-xl text-lg font-bold text-slate-600">-</button>
                        <input id="quantity" name="quantity" type="number" min="1" max="50" value="1" required class="block w-20 text-center py-3 border border-slate-200 rounded-xl text-sm font-bold focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50" oninput="calculateTotal()">
                        <button type="button" onclick="adjustQty(1)" class="w-11 h-11 border border-slate-200 bg-slate-50 hover:bg-slate-100 rounded-xl text-lg font-bold text-slate-600">+</button>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-2xl text-base font-bold shadow-lg shadow-amber-500/20 flex items-center justify-center gap-2">
                    🚀 Lanjutkan Ke Pembayaran
                </button>
            </form>
        </div>

        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm sticky top-24 space-y-6">
                <h3 class="text-lg font-bold text-slate-900 pb-4 border-b border-slate-150">Ringkasan Pemesanan</h3>
                <div class="space-y-4 text-sm font-medium">
                    <div class="flex justify-between text-slate-500"><span>Jenis Tiket</span><span id="summary-ticket" class="text-slate-900 font-bold">-</span></div>
                    <div class="flex justify-between text-slate-500"><span>Periode Kunjungan</span><span id="summary-period" class="text-slate-900 font-bold text-right">-</span></div>
                    <div class="flex justify-between text-slate-500"><span>Harga Satuan</span><span id="summary-price" class="text-slate-900 font-bold">Rp 0</span></div>
                    <div class="flex justify-between text-slate-500"><span>Jumlah Pembelian</span><span id="summary-qty" class="text-slate-900 font-bold">1 Tiket</span></div>
                    <div class="border-t border-slate-100 pt-4 flex justify-between items-end"><span class="block text-xs text-slate-400 font-bold uppercase tracking-wider">Total Pembayaran</span><span id="summary-total" class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-amber-500">Rp 0</span></div>
                </div>
                <div class="p-4 bg-sky-50 border border-sky-100 rounded-2xl flex gap-3 text-xs text-sky-800"><span class="text-xl">💡</span><p class="leading-relaxed font-semibold">Setelah checkout, unggah bukti transfer untuk diverifikasi admin.</p></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function rupiah(v){return 'Rp '+Number(v||0).toLocaleString('id-ID')}
function formatDate(date){return date ? new Date(date+'T00:00:00').toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'}) : '-'}
function syncEndDate(){const start=document.getElementById('visit_start_date');const end=document.getElementById('visit_end_date');end.min=start.value;if(end.value < start.value){end.value=start.value}}
function adjustQty(delta){const input=document.getElementById('quantity');input.value=Math.max(1,Math.min(50,(parseInt(input.value)||1)+delta));calculateTotal()}
function calculateTotal(){let price=0,name='-';document.querySelectorAll('.ticket-label').forEach(label=>{const radio=label.querySelector('input[type=radio]');if(radio && radio.checked){price=parseInt(radio.dataset.price)||0;name=radio.dataset.name;label.classList.add('border-amber-500','bg-amber-50/20')}else{label.classList.remove('border-amber-500','bg-amber-50/20')}});const qty=parseInt(document.getElementById('quantity').value)||1;const start=document.getElementById('visit_start_date').value;const end=document.getElementById('visit_end_date').value;document.getElementById('summary-ticket').innerText=name;document.getElementById('summary-period').innerText=formatDate(start)+' - '+formatDate(end);document.getElementById('summary-price').innerText=rupiah(price);document.getElementById('summary-qty').innerText=qty+' Tiket';document.getElementById('summary-total').innerText=rupiah(price*qty)}
window.addEventListener('DOMContentLoaded',()=>{syncEndDate();calculateTotal()});
</script>
@endsection
