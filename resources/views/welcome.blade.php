@extends('layouts.guest')

@section('title', 'Beranda')

@section('guest-content')
<!-- Hero Section -->
<section id="beranda" class="relative overflow-hidden bg-gradient-to-b from-sky-50 to-amber-50/50 pt-16 pb-24 sm:pt-24 sm:pb-32">
    <!-- Decorative Beach Elements -->
    <div class="absolute inset-y-0 right-0 -z-10 w-full sm:w-1/2 opacity-20 sm:opacity-100">
        <svg class="h-full w-full object-cover text-amber-200/50" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 80, 40 80, 60 100 C 80 80, 100 80, 100 100 Z" />
            <circle cx="85" cy="20" r="10" class="text-amber-400" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Text Content -->
            <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-semibold uppercase tracking-wider">
                    🎉 Destinasi Rekreasi Keluarga Terpopuler di Cilegon
                </div>
                <h1 class="text-4xl sm:text-6xl font-extrabold text-slate-900 tracking-tight leading-none">
                    Keajaiban Dunia <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 via-amber-500 to-sky-500">
                        Istana Pasir Cilegon
                    </span>
                </h1>
                <p class="text-lg text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Nikmati keindahan istana pasir termegah, taman rekreasi keluarga berstandar modern, kolam renang anak, spot foto instagramable, dan petualangan seru yang tak terlupakan!
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="#tiket" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-2xl text-base font-bold shadow-lg shadow-amber-500/30 hover:shadow-amber-500/40 transform hover:-translate-y-0.5 transition-all text-center">
                        Pesan Tiket Sekarang 🎟️
                    </a>
                    <a href="#fasilitas" class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-2xl text-base font-bold shadow-sm transition-all text-center">
                        Lihat Wahana & Fasilitas
                    </a>
                </div>

                <!-- Quick stats / Highlights -->
                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-200 max-w-md mx-auto lg:mx-0">
                    <div>
                        <span class="block text-2xl font-bold text-slate-900">10+</span>
                        <span class="block text-xs text-slate-500 font-medium">Wahana Seru</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold text-slate-900">4.8★</span>
                        <span class="block text-xs text-slate-500 font-medium">Ulasan Pengunjung</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold text-slate-900">100k+</span>
                        <span class="block text-xs text-slate-500 font-medium">Tiket Terjual</span>
                    </div>
                </div>
            </div>

            <!-- Right Image/Visual Component -->
            <div class="lg:col-span-5 relative">
                <!-- Outer floating element -->
                <div class="absolute -top-6 -left-6 bg-white p-4 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce z-10" style="animation-duration: 4s;">
                    <span class="p-2 bg-sky-100 text-sky-600 rounded-lg">
                        🌊
                    </span>
                    <div>
                        <span class="block font-bold text-xs text-slate-900">Suasana Pantai</span>
                        <span class="block text-[10px] text-slate-500">Angin laut yang sejuk</span>
                    </div>
                </div>

                <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce z-10" style="animation-duration: 6s;">
                    <span class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                        🏰
                    </span>
                    <div>
                        <span class="block font-bold text-xs text-slate-900">Istana Pasir Raksasa</span>
                        <span class="block text-[10px] text-slate-500">Pahatan seniman dunia</span>
                    </div>
                </div>

                <div class="aspect-square bg-gradient-to-tr from-amber-400 to-sky-400 rounded-[2.5rem] shadow-2xl overflow-hidden p-3 transform rotate-2 hover:rotate-0 transition-transform duration-500">
                    <!-- High fidelity visual mockup placeholder using SVG/Tailwind -->
                    <div class="w-full h-full bg-slate-900 rounded-[2rem] overflow-hidden relative flex flex-col items-center justify-center p-6 text-center text-white">
                        <div class="absolute inset-0 opacity-40 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                        <div class="absolute -bottom-10 inset-x-0 h-40 bg-gradient-to-t from-amber-600/80 to-transparent"></div>

                        <!-- Mini simulated sandcastle -->
                        <span class="text-7xl mb-4 block">🏰</span>
                        <h3 class="text-2xl font-bold tracking-tight">Wisata Istana Pasir Cilegon</h3>
                        <p class="text-xs text-slate-300 max-w-xs mt-2">
                            Rasakan petualangan pantai eksotis di tengah hamparan istana pasir megah & berbagai wahana taman hiburan keluarga.
                        </p>

                        <div class="mt-6 inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Buka Hari Ini: 08:00 - 17:00 WIB
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Galeri Foto Terbaru -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <h2 class="text-xs font-bold text-sky-600 uppercase tracking-widest">📸 Galeri Foto</h2>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Momen Seru di Istana Pasir</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach(['estetik.jpeg', 'istana.jpg', 'kolam.jpg', 'images (3).webp', 'images (4).webp', '12.webp', 'hana.jpg', 'kolamm.jpg'] as $foto)
                <div class="aspect-square w-full overflow-hidden rounded-2xl shadow-sm border border-slate-200">
                    <img src="{{ asset('images/' . $foto) }}" alt="Foto Galeri" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Ticket List Section -->
<section id="tiket" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <h2 class="text-xs font-bold text-amber-600 uppercase tracking-widest">📋 Daftar Tiket Wisata</h2>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Pilih Paket Tiket Terbaik Anda</p>
            <p class="text-base text-slate-500">
                Temukan pilihan tiket masuk yang sesuai dengan kebutuhan liburan keluarga Anda. Pesan secara online untuk menghindari antrean di loket!
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Ticket Card 1: Regular Dewasa -->
            <div class="bg-gradient-to-b from-slate-50 to-white rounded-3xl border border-slate-100 p-8 flex flex-col justify-between hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-200 transition-all group relative">
                <div>
                    <div class="flex justify-between items-start mb-6">
                        <span class="p-3 bg-amber-50 text-amber-600 rounded-2xl group-hover:bg-amber-500 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg uppercase tracking-wider">
                            Tersedia
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition-colors">Tiket Regular Dewasa</h3>
                    <p class="text-xs text-slate-400 mt-1">Satu Tiket Masuk per Orang (Dewasa)</p>

                    <p class="text-3xl font-extrabold text-slate-900 mt-6">
                        Rp 30.000 <span class="text-xs text-slate-400 font-normal">/orang</span>
                    </p>

                    <ul class="mt-6 space-y-3.5 text-sm text-slate-600 border-t border-slate-100 pt-6">
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Akses Area Istana Pasir Utama
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Spot Foto Selfie Instagramable
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-slate-300">✗</span> Akses Wahana Air Anak (Kolam Renang)
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-slate-300">✗</span> Voucher Soft Drink Gratis
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="block text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Sisa Tiket</span>
                        <span class="font-bold text-sm text-amber-600">350 Tiket / Hari</span>
                    </div>
                    <a href="{{ url('/login') }}" class="px-5 py-3 bg-slate-900 hover:bg-amber-600 text-white rounded-xl text-xs font-bold shadow-md hover:shadow-lg transition-all">
                        Pesan Sekarang
                    </a>
                </div>
            </div>

            <!-- Ticket Card 2: Terusan VIP (Best Seller) -->
            <div class="bg-gradient-to-b from-amber-50/30 to-white rounded-3xl border-2 border-amber-500/80 p-8 flex flex-col justify-between hover:shadow-2xl hover:shadow-amber-500/20 transition-all group relative">
                <!-- Popular Badge -->
                <div class="absolute -top-4 right-8 bg-gradient-to-r from-amber-500 to-amber-600 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-md">
                    ⭐ PALING POPULER
                </div>

                <div>
                    <div class="flex justify-between items-start mb-6">
                        <span class="p-3 bg-amber-500 text-white rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.98 20.53a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </span>
                        <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg uppercase tracking-wider">
                            Tersedia
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900">Tiket Terusan VIP</h3>
                    <p class="text-xs text-slate-400 mt-1">Akses Penuh Semua Wahana & Fasilitas</p>

                    <p class="text-3xl font-extrabold text-slate-900 mt-6">
                        Rp 75.000 <span class="text-xs text-slate-400 font-normal">/orang</span>
                    </p>

                    <ul class="mt-6 space-y-3.5 text-sm text-slate-600 border-t border-slate-100 pt-6">
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Akses Area Istana Pasir Utama
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Spot Foto Selfie Instagramable
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Akses Wahana Air (Kolam Renang Anak & Dewasa)
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Arena Bermain Istana Pasir Mandiri
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Voucher Soft Drink & Ice Cream Gratis
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="block text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Sisa Tiket</span>
                        <span class="font-bold text-sm text-amber-600">120 Tiket / Hari</span>
                    </div>
                    <a href="{{ url('/login') }}" class="px-5 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl text-xs font-bold shadow-md hover:shadow-lg transition-all">
                        Pesan Sekarang
                    </a>
                </div>
            </div>

            <!-- Ticket Card 3: Regular Anak -->
            <div class="bg-gradient-to-b from-slate-50 to-white rounded-3xl border border-slate-100 p-8 flex flex-col justify-between hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-200 transition-all group relative">
                <div>
                    <div class="flex justify-between items-start mb-6">
                        <span class="p-3 bg-amber-50 text-amber-600 rounded-2xl group-hover:bg-amber-500 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                        <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg uppercase tracking-wider">
                            Tersedia
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition-colors">Tiket Regular Anak</h3>
                    <p class="text-xs text-slate-400 mt-1">Satu Tiket Masuk per Anak (Di bawah 12 th)</p>

                    <p class="text-3xl font-extrabold text-slate-900 mt-6">
                        Rp 20.000 <span class="text-xs text-slate-400 font-normal">/orang</span>
                    </p>

                    <ul class="mt-6 space-y-3.5 text-sm text-slate-600 border-t border-slate-100 pt-6">
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Akses Area Istana Pasir Utama
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Spot Foto Selfie Instagramable
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-500">✓</span> Akses Wahana Air Anak (Kolam Renang)
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-slate-300">✗</span> Voucher Soft Drink Gratis
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="block text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Sisa Tiket</span>
                        <span class="font-bold text-sm text-amber-600">420 Tiket / Hari</span>
                    </div>
                    <a href="{{ url('/login') }}" class="px-5 py-3 bg-slate-900 hover:bg-amber-600 text-white rounded-xl text-xs font-bold shadow-md hover:shadow-lg transition-all">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section id="fasilitas" class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <h2 class="text-xs font-bold text-sky-600 uppercase tracking-widest">🎡 Wahana & Fasilitas</h2>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Keseruan Tanpa Batas Untuk Keluarga</p>
            <p class="text-base text-slate-500">
                Kami menyediakan berbagai fasilitas rekreasi premium untuk memastikan liburan Anda berkesan, seru, aman, dan nyaman.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Facility 1 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <span class="text-4xl mb-4 block">🏰</span>
                <h4 class="text-lg font-bold text-slate-900 mb-2">Istana Pasir Raksasa</h4>
                <p class="text-sm text-slate-500">Pahatan istana pasir megah setinggi 10 meter garapan seniman profesional internasional.</p>
            </div>
            <!-- Facility 2 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <span class="text-4xl mb-4 block">🏊</span>
                <h4 class="text-lg font-bold text-slate-900 mb-2">Kolam Renang Anak</h4>
                <p class="text-sm text-slate-500">Kolam renang air bersih yang aman dilengkapi perosotan air (water slide) dan ember tumpah.</p>
            </div>
            <!-- Facility 3 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <span class="text-4xl mb-4 block">📸</span>
                <h4 class="text-lg font-bold text-slate-900 mb-2">Spot Foto Estetik</h4>
                <p class="text-sm text-slate-500">Puluhan sudut foto instagramable bernuansa pantai tropis, balon udara, dan replika dunia.</p>
            </div>
            <!-- Facility 4 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <span class="text-4xl mb-4 block">🍔</span>
                <h4 class="text-lg font-bold text-slate-900 mb-2">Culinary Food Court</h4>
                <p class="text-sm text-slate-500">Pusat jajanan kuliner khas Banten dan hidangan modern dengan harga yang sangat terjangkau.</p>
            </div>
        </div>
    </div>
</section>
@endsection
