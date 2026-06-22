@extends('layouts.app')

@section('content')
<!-- Header / Navbar -->
<header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <span class="p-2 bg-gradient-to-tr from-amber-500 to-sky-500 rounded-xl text-white shadow-md shadow-amber-500/20 group-hover:scale-105 transition-transform">
                        <!-- Simulated sand castle / beach icon with SVG -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </span>
                    <div>
                        <span class="font-bold text-lg text-slate-900 tracking-tight block">Istana Pasir</span>
                        <span class="text-xs text-amber-600 font-semibold tracking-wider uppercase block -mt-1">Cilegon</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
                <a href="{{ url('/') }}#beranda" class="hover:text-amber-600 transition-colors">Beranda</a>
                <a href="{{ url('/') }}#tiket" class="hover:text-amber-600 transition-colors">Daftar Tiket</a>
                <a href="{{ url('/') }}#fasilitas" class="hover:text-amber-600 transition-colors">Fasilitas</a>
                <a href="{{ url('/') }}#kontak" class="hover:text-amber-600 transition-colors">Kontak</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/login') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-amber-600 transition-colors">
                    Masuk
                </a>
                <a href="{{ url('/register') }}" class="px-5 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl text-sm font-medium shadow-md shadow-amber-500/20 hover:shadow-lg hover:shadow-amber-500/30 transition-all">
                    Daftar Akun
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Main Page Content -->
<main class="flex-grow">
    @yield('guest-content')
</main>

<!-- Footer -->
<footer id="kontak" class="bg-slate-900 text-slate-400 pt-16 pb-8 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <!-- Brand Column -->
            <div class="md:col-span-2 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="p-2 bg-gradient-to-tr from-amber-500 to-sky-500 rounded-xl text-white shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </span>
                    <span class="font-bold text-lg text-white">Wisata Istana Pasir Cilegon</span>
                </div>
                <p class="text-sm text-slate-400 max-w-sm leading-relaxed">
                    Nikmati keindahan wisata rekreasi keluarga bernuansa pantai, istana pasir megah, kolam renang anak, spot foto estetik, dan arena bermain seru di tengah kota Cilegon.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Navigasi</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ url('/') }}#beranda" class="hover:text-amber-500 transition-colors">Beranda</a></li>
                    <li><a href="{{ url('/') }}#tiket" class="hover:text-amber-500 transition-colors">Daftar Tiket</a></li>
                    <li><a href="{{ url('/') }}#fasilitas" class="hover:text-amber-500 transition-colors">Fasilitas</a></li>
                    <li><a href="{{ url('/login') }}" class="hover:text-amber-500 transition-colors">Masuk</a></li>
                </ul>
            </div>

            <!-- Contact & Socials -->
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Kontak & Lokasi</h4>
                <p class="text-sm leading-relaxed mb-4">
                    Jl. Istana Pasir No. 12, Cibeber,<br>
                    Kota Cilegon, Banten 42424
                </p>
                <div class="space-y-1 text-sm text-slate-400">
                    <p>📧 info@istanapasircilegon.com</p>
                    <p>📞 +62 812-3456-7890</p>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} Wisata Istana Pasir Cilegon. Seluruh Hak Cipta Dilindungi.</p>
            <p>Didesain dengan ❤️ oleh expert Laravel Developer</p>
        </div>
    </div>
</footer>
@endsection
