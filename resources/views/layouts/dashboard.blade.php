@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
    $role = $user?->role ?? 'admin';
    $roleMeta = [
        'admin' => ['label' => 'Administrator', 'initial' => 'AD', 'home' => route('admin.dashboard'), 'tone' => 'bg-amber-500 text-slate-950'],
        'petugas' => ['label' => 'Petugas Loket', 'initial' => 'PL', 'home' => route('petugas.scan'), 'tone' => 'bg-sky-500 text-white'],
        'owner' => ['label' => 'Owner / Pemilik', 'initial' => 'OW', 'home' => route('owner.dashboard'), 'tone' => 'bg-emerald-500 text-white'],
    ][$role] ?? ['label' => 'Staff', 'initial' => 'ST', 'home' => url('/'), 'tone' => 'bg-slate-500 text-white'];

    $navItems = match ($role) {
        'admin' => [
            ['label' => 'Dashboard', 'icon' => '📊', 'href' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard')],
            ['label' => 'Data Tiket', 'icon' => '🎫', 'href' => route('admin.tickets'), 'active' => request()->routeIs('admin.tickets')],
            ['label' => 'Data Pemesanan', 'icon' => '📋', 'href' => route('admin.bookings'), 'active' => request()->routeIs('admin.bookings')],
            ['label' => 'Pembayaran', 'icon' => '💳', 'href' => route('admin.payments'), 'active' => request()->routeIs('admin.payments')],
            ['label' => 'Laporan', 'icon' => '📈', 'href' => route('admin.reports'), 'active' => request()->routeIs('admin.reports')],
        ],
        'petugas' => [
            ['label' => 'Dashboard Loket', 'icon' => '🛂', 'href' => route('petugas.scan'), 'active' => request()->routeIs('petugas.scan')],
            ['label' => 'Scan E-Tiket', 'icon' => '📷', 'href' => route('petugas.scan').'#scan', 'active' => false],
            ['label' => 'Validasi Masuk', 'icon' => '✅', 'href' => route('petugas.scan').'#riwayat', 'active' => false],
        ],
        'owner' => [
            ['label' => 'Dashboard Owner', 'icon' => '👑', 'href' => route('owner.dashboard'), 'active' => request()->routeIs('owner.dashboard')],
            ['label' => 'Analisis Revenue', 'icon' => '📈', 'href' => route('owner.dashboard').'#revenue', 'active' => false],
            ['label' => 'Performa Tiket', 'icon' => '🎫', 'href' => route('owner.dashboard').'#tickets', 'active' => false],
            ['label' => 'Ringkasan Laporan', 'icon' => '🧾', 'href' => route('owner.dashboard').'#laporan', 'active' => false],
        ],
        default => [],
    };
@endphp

<div class="min-h-screen bg-slate-100 flex flex-col md:flex-row" x-data="{ sidebarOpen: false }">
    <aside class="hidden md:flex flex-col w-72 bg-slate-900 text-slate-400 min-h-screen flex-shrink-0 z-30">
        <div class="h-20 flex items-center justify-center border-b border-slate-800 bg-slate-950 px-6">
            <a href="{{ $roleMeta['home'] }}" class="flex items-center gap-2.5">
                <span class="p-2.5 bg-gradient-to-tr from-amber-500 to-sky-500 rounded-2xl text-white shadow-md">🏰</span>
                <div>
                    <span class="font-extrabold text-lg text-white tracking-tight block">Istana Pasir</span>
                    <span class="text-[10px] text-amber-400 font-bold uppercase tracking-widest block -mt-1">{{ $roleMeta['label'] }}</span>
                </div>
            </a>
        </div>

        <nav class="flex-grow p-5 space-y-2 text-sm font-semibold">
            <p class="text-[10px] uppercase font-bold tracking-wider text-slate-600 px-3 mb-2">Navigasi Panel</p>
            @foreach($navItems as $item)
                <a href="{{ $item['href'] }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ $item['active'] ? 'bg-amber-500 text-slate-950 font-bold shadow-lg shadow-amber-500/20' : 'hover:bg-slate-800 hover:text-white' }}">
                    <span>{{ $item['icon'] }}</span>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach

            @if($role === 'admin')
                <div class="pt-6">
                    <p class="text-[10px] uppercase font-bold tracking-wider text-slate-600 px-3 mb-2">Akses Role Demo</p>
                    <div class="grid grid-cols-1 gap-2">
                        <a href="{{ route('petugas.scan') }}" class="px-4 py-2.5 rounded-xl bg-slate-800/70 hover:bg-sky-500 hover:text-white transition-all">🛂 Panel Petugas</a>
                        <a href="{{ route('owner.dashboard') }}" class="px-4 py-2.5 rounded-xl bg-slate-800/70 hover:bg-emerald-500 hover:text-white transition-all">👑 Panel Owner</a>
                    </div>
                </div>
            @endif
        </nav>

        <div class="p-5 border-t border-slate-800 bg-slate-950 text-xs text-slate-500 space-y-3">
            <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span><span>Sistem Aktif (Front-End v1)</span></div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full px-3 py-2 bg-slate-800 hover:bg-rose-600 hover:text-white rounded-lg text-center font-bold transition-all">Logout</button>
            </form>
        </div>
    </aside>

    <div class="md:hidden" x-show="sidebarOpen" style="display: none;">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40" @click="sidebarOpen = false"></div>
        <aside class="fixed inset-y-0 left-0 w-72 bg-slate-900 text-slate-400 z-50 flex flex-col">
            <div class="h-20 flex items-center justify-between border-b border-slate-800 bg-slate-950 px-6">
                <span class="font-extrabold text-base text-white tracking-tight">Istana Pasir Staff</span>
                <button @click="sidebarOpen = false" class="text-slate-400 hover:text-white text-xl">✕</button>
            </div>
            <nav class="flex-grow p-5 space-y-2 text-sm font-semibold">
                @foreach($navItems as $item)
                    <a href="{{ $item['href'] }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ $item['active'] ? 'bg-amber-500 text-slate-950 font-bold' : 'hover:bg-slate-800 hover:text-white' }}">
                        <span>{{ $item['icon'] }}</span><span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </aside>
    </div>

    <div class="flex-grow flex flex-col min-w-0 min-h-screen">
        <header class="bg-white border-b border-slate-200 h-20 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-20">
            <div class="flex items-center gap-4 min-w-0">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <div class="min-w-0">
                    <h1 class="text-lg font-bold text-slate-900 leading-tight truncate">@yield('dashboard-title', 'Dashboard Panel')</h1>
                    <p class="text-xs text-slate-500 truncate">Sistem Informasi Pemesanan Tiket Wisata Istana Pasir Cilegon</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold {{ $roleMeta['tone'] }}">{{ $roleMeta['label'] }}</span>
                <div class="flex items-center gap-3 pl-4 border-l border-slate-200">
                    <div class="text-right hidden sm:block">
                        <span class="block text-sm font-bold text-slate-900 leading-tight">{{ $user?->name ?? 'Demo User' }}</span>
                        <span class="block text-[10px] text-slate-400 font-semibold">{{ $user?->email ?? 'demo@istanapasir.test' }}</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-sky-500 text-white flex items-center justify-center font-bold shadow-md shadow-amber-500/10">{{ strtoupper(substr($user?->name ?? $roleMeta['initial'], 0, 2)) }}</div>
                </div>
            </div>
        </header>

        <main class="flex-grow p-6 sm:p-8">
            @if (session('success'))<div class="mb-6 p-4 rounded-2xl bg-emerald-50 text-emerald-700 text-sm font-bold border border-emerald-100">{{ session('success') }}</div>@endif
            @if (session('error'))<div class="mb-6 p-4 rounded-2xl bg-rose-50 text-rose-700 text-sm font-bold border border-rose-100">{{ session('error') }}</div>@endif
            @yield('dashboard-content')
        </main>

        <footer class="bg-white border-t border-slate-200 py-4 px-8 text-center sm:text-left text-xs text-slate-400 flex flex-col sm:flex-row justify-between gap-2">
            <span>&copy; {{ date('Y') }} Wisata Istana Pasir Cilegon. Unified Control Desk.</span>
            <span>Laravel 11 + Tailwind CSS + Blade</span>
        </footer>
    </div>
</div>
@endsection
