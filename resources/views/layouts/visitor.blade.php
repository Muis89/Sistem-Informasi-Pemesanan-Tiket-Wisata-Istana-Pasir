@extends('layouts.app')

@section('content')
@php($latestPaid = auth()->user()?->pemesanans()->whereHas('eTiket')->latest()->first())
<div class="min-h-screen flex flex-col bg-slate-50">
    <header class="bg-white border-b border-slate-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="p-1.5 bg-gradient-to-tr from-amber-500 to-sky-500 rounded-lg text-white shadow-md">🏰</span>
                        <div>
                            <span class="font-bold text-base text-slate-900 tracking-tight block">Istana Pasir</span>
                            <span class="text-[10px] text-amber-600 font-semibold uppercase tracking-wider block -mt-1">Dashboard Pengunjung</span>
                        </div>
                    </a>
                </div>

                <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
                    <a href="{{ route('visitor.dashboard') }}" class="hover:text-amber-600 transition-colors py-5 border-b-2 border-transparent hover:border-amber-500 {{ request()->routeIs('visitor.dashboard') ? 'text-amber-600 border-amber-500' : '' }}">🏠 Beranda</a>
                    <a href="{{ route('visitor.book') }}" class="hover:text-amber-600 transition-colors py-5 border-b-2 border-transparent hover:border-amber-500 {{ request()->routeIs('visitor.book') ? 'text-amber-600 border-amber-500' : '' }}">🎟️ Pesan Tiket</a>
                    @if($latestPaid)
                        <a href="{{ route('visitor.ticket', $latestPaid) }}" class="hover:text-amber-600 transition-colors py-5 border-b-2 border-transparent hover:border-amber-500 {{ request()->routeIs('visitor.ticket') ? 'text-amber-600 border-amber-500' : '' }}">🎫 E-Tiket Saya</a>
                    @endif
                </nav>

                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-sm font-bold text-slate-900">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-amber-600 font-semibold">Pengunjung</span>
                    </div>

                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-200 to-sky-200 flex items-center justify-center font-bold text-slate-700 shadow-inner border border-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="flex items-center flex-shrink-0">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-3.5 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-bold transition-all shadow-md hover:shadow-rose-600/20" title="Keluar dari Akun">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </header>

    <div class="md:hidden bg-white border-b border-slate-100 px-4 py-2 flex justify-around text-xs font-semibold text-slate-600 sticky top-16 z-40 shadow-sm">
        <a href="{{ route('visitor.dashboard') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('visitor.dashboard') ? 'text-amber-600' : '' }}">
            <span>🏠</span>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('visitor.book') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('visitor.book') ? 'text-amber-600' : '' }}">
            <span>🎟️</span>
            <span>Beli</span>
        </a>
        @if($latestPaid)
            <a href="{{ route('visitor.ticket', $latestPaid) }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('visitor.ticket') ? 'text-amber-600' : '' }}">
                <span>🎫</span>
                <span>Tiket</span>
            </a>
        @endif
    </div>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('visitor-content')
    </main>

    <footer class="bg-white border-t border-slate-100 py-6 text-center text-xs text-slate-400">
        &copy; {{ date('Y') }} Wisata Istana Pasir Cilegon. Panel Pengunjung v1.0.
    </footer>
</div>
@endsection
