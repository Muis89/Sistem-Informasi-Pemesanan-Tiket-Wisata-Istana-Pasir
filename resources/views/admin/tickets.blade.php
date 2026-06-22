@extends('layouts.dashboard')

@section('dashboard-title', 'Kelola Data Tiket')

@section('dashboard-content')
<div x-data="{ addModalOpen: false, editModalOpen: false, deleteModalOpen: false, selectedTicket: {name: '', price: '', stock: '', desc: ''} }">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Daftar Kategori Tiket Wisata</h2>
            <p class="text-xs text-slate-500">Kelola informasi harga, sisa kuota harian, serta tipe tiket di Istana Pasir Cilegon</p>
        </div>
        <button @click="addModalOpen = true" class="px-5 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold rounded-xl text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
            <span>➕</span> <span>Tambah Tiket Baru</span>
        </button>
    </div>

    <!-- Tabular list card -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-wider border-b border-slate-100">
                        <th class="py-4 px-6">Nama Tiket</th>
                        <th class="py-4 px-6">Harga</th>
                        <th class="py-4 px-6">Kapasitas Slot / Hari</th>
                        <th class="py-4 px-6">Deskripsi Tiket</th>
                        <th class="py-4 px-6">Status Kuota</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-semibold">
                    <!-- Ticket 1 -->
                    <tr class="hover:bg-slate-50/40 transition-colors">
                        <td class="py-4 px-6 text-slate-900 font-bold">Terusan VIP ⭐</td>
                        <td class="py-4 px-6 font-extrabold text-slate-950">Rp 75.000</td>
                        <td class="py-4 px-6">120 Tiket</td>
                        <td class="py-4 px-6 text-xs text-slate-500 font-normal max-w-xs leading-relaxed">Akses penuh semua wahana utama, kolam renang anak & dewasa, spot foto, serta free soft drink & ice cream.</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                Melimpah
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="selectedTicket = {name: 'Terusan VIP ⭐', price: '75000', stock: '120', desc: 'Akses penuh semua wahana utama, kolam renang anak & dewasa, spot foto, serta free soft drink & ice cream.'}; editModalOpen = true" class="p-2 bg-slate-50 hover:bg-amber-100 hover:text-amber-700 rounded-lg text-slate-500 border border-slate-200 transition-all text-xs">
                                    ✏️ Edit
                                </button>
                                <button @click="selectedTicket = {name: 'Terusan VIP ⭐'}; deleteModalOpen = true" class="p-2 bg-slate-50 hover:bg-rose-50 hover:text-rose-600 rounded-lg text-slate-500 border border-slate-200 transition-all text-xs">
                                    🗑️ Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Ticket 2 -->
                    <tr class="hover:bg-slate-50/40 transition-colors">
                        <td class="py-4 px-6 text-slate-900 font-bold">Regular Dewasa</td>
                        <td class="py-4 px-6 font-extrabold text-slate-950">Rp 30.000</td>
                        <td class="py-4 px-6">350 Tiket</td>
                        <td class="py-4 px-6 text-xs text-slate-500 font-normal max-w-xs leading-relaxed">Satu tiket masuk per orang dewasa. Belum termasuk akses ke wahana air (kolam renang) dan playground anak.</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                Melimpah
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="selectedTicket = {name: 'Regular Dewasa', price: '30000', stock: '350', desc: 'Satu tiket masuk per orang dewasa. Belum termasuk akses ke wahana air (kolam renang) dan playground anak.'}; editModalOpen = true" class="p-2 bg-slate-50 hover:bg-amber-100 hover:text-amber-700 rounded-lg text-slate-500 border border-slate-200 transition-all text-xs">
                                    ✏️ Edit
                                </button>
                                <button @click="selectedTicket = {name: 'Regular Dewasa'}; deleteModalOpen = true" class="p-2 bg-slate-50 hover:bg-rose-50 hover:text-rose-600 rounded-lg text-slate-500 border border-slate-200 transition-all text-xs">
                                    🗑️ Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Ticket 3 -->
                    <tr class="hover:bg-slate-50/40 transition-colors">
                        <td class="py-4 px-6 text-slate-900 font-bold">Regular Anak</td>
                        <td class="py-4 px-6 font-extrabold text-slate-950">Rp 20.000</td>
                        <td class="py-4 px-6">420 Tiket</td>
                        <td class="py-4 px-6 text-xs text-slate-500 font-normal max-w-xs leading-relaxed">Satu tiket masuk per anak (di bawah 12 th). Termasuk akses penuh ke area Istana Pasir utama & kolam renang anak.</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-yellow-100 text-yellow-800">
                                Terbatas
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="selectedTicket = {name: 'Regular Anak', price: '20000', stock: '420', desc: 'Satu tiket masuk per anak (di bawah 12 th). Termasuk akses penuh ke area Istana Pasir utama & kolam renang anak.'}; editModalOpen = true" class="p-2 bg-slate-50 hover:bg-amber-100 hover:text-amber-700 rounded-lg text-slate-500 border border-slate-200 transition-all text-xs">
                                    ✏️ Edit
                                </button>
                                <button @click="selectedTicket = {name: 'Regular Anak'}; deleteModalOpen = true" class="p-2 bg-slate-50 hover:bg-rose-50 hover:text-rose-600 rounded-lg text-slate-500 border border-slate-200 transition-all text-xs">
                                    🗑️ Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL 1: TAMBAH TIKET -->
    <div class="fixed inset-0 bg-slate-900/65 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-show="addModalOpen" style="display: none;">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 space-y-6 shadow-2xl relative border border-slate-100" @click.away="addModalOpen = false">
            <h3 class="text-lg font-bold text-slate-900">Tambah Kategori Tiket Baru</h3>
            <form action="#" method="POST" class="space-y-4" @submit.prevent="addModalOpen = false; alert('Dummy: Sukses menambahkan tiket baru!');">
                <!-- Name -->
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Nama Tiket</label>
                    <input type="text" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50" placeholder="Contoh: Tiket Terusan Akhir Pekan">
                </div>
                <!-- Price -->
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Harga Tiket (Rupiah)</label>
                    <input type="number" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50" placeholder="Contoh: 50000">
                </div>
                <!-- Stock -->
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Kuota Harian (Tiket)</label>
                    <input type="number" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50" placeholder="Contoh: 200">
                </div>
                <!-- Description -->
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Deskripsi Detail</label>
                    <textarea rows="3" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50" placeholder="Tuliskan rincian akses wahana tiket ini..."></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" @click="addModalOpen = false" class="flex-grow py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-bold transition-all">
                        Batal
                    </button>
                    <button type="submit" class="flex-grow py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl text-sm font-bold shadow-md shadow-amber-500/10 transition-all">
                        Simpan Tiket
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 2: UBAH TIKET -->
    <div class="fixed inset-0 bg-slate-900/65 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-show="editModalOpen" style="display: none;">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 space-y-6 shadow-2xl relative border border-slate-100" @click.away="editModalOpen = false">
            <h3 class="text-lg font-bold text-slate-900">Ubah Kategori Tiket</h3>
            <form action="#" method="POST" class="space-y-4" @submit.prevent="editModalOpen = false; alert('Dummy: Sukses menyimpan perubahan tiket!');">
                <!-- Name -->
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Nama Tiket</label>
                    <input type="text" required x-model="selectedTicket.name" class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50">
                </div>
                <!-- Price -->
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Harga Tiket (Rupiah)</label>
                    <input type="number" required x-model="selectedTicket.price" class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50">
                </div>
                <!-- Stock -->
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Kuota Harian (Tiket)</label>
                    <input type="number" required x-model="selectedTicket.stock" class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50">
                </div>
                <!-- Description -->
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Deskripsi Detail</label>
                    <textarea rows="3" required x-model="selectedTicket.desc" class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50"></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" @click="editModalOpen = false" class="flex-grow py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-bold transition-all">
                        Batal
                    </button>
                    <button type="submit" class="flex-grow py-3 px-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl text-sm font-bold shadow-md shadow-amber-500/10 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 3: HAPUS TIKET -->
    <div class="fixed inset-0 bg-slate-900/65 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-show="deleteModalOpen" style="display: none;">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 text-center space-y-6 shadow-2xl relative border border-slate-100" @click.away="deleteModalOpen = false">
            <span class="text-5xl block">⚠️</span>
            <div class="space-y-2">
                <h3 class="text-lg font-bold text-slate-900">Konfirmasi Hapus Tiket</h3>
                <p class="text-sm text-slate-500">
                    Apakah Anda yakin ingin menghapus tiket <strong class="text-rose-600" x-text="selectedTicket.name"></strong>? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            <div class="flex gap-3">
                <button type="button" @click="deleteModalOpen = false" class="flex-grow py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-bold transition-all">
                    Batal
                </button>
                <button type="button" @click="deleteModalOpen = false; alert('Dummy: Sukses menghapus data tiket!');" class="flex-grow py-3 px-4 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-sm font-bold shadow-md shadow-rose-600/10 transition-all">
                    Hapus Permanen
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
