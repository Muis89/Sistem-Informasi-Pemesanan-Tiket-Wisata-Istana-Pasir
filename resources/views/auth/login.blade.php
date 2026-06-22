@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-50 via-white to-sky-50 px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 font-black text-slate-900 text-xl"><span class="p-2 rounded-xl bg-gradient-to-tr from-amber-500 to-sky-500 text-white">🏰</span> Istana Pasir</a>
        </div>
        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-xl border border-white p-8 sm:p-10">
            <div class="text-center space-y-2">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang Kembali</h2>
                <p class="text-sm text-slate-500">Masuk untuk memesan tiket wisata.</p>
            </div>

            @if ($errors->any())<div class="mt-6 p-3 rounded-xl bg-rose-50 text-rose-700 text-sm font-semibold">{{ $errors->first() }}</div>@endif
            @if (session('success'))<div class="mt-6 p-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-semibold">{{ session('success') }}</div>@endif

            <form class="mt-8 space-y-6" action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="space-y-1.5">
                    <label for="username" class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Username atau Email</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50" placeholder="nama@email.com atau username">
                </div>
                <div class="space-y-1.5">
                    <label for="password" class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Password</label>
                    <input id="password" name="password" type="password" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all bg-slate-50/50" placeholder="••••••••">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600"><input type="checkbox" name="remember" class="rounded border-slate-300 text-amber-600 focus:ring-amber-500"> Ingat saya</label>
                <button type="submit" class="w-full py-3.5 px-6 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-amber-500/20 transition-all">Login</button>
            </form>
            <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-amber-600 hover:text-amber-700">Daftar sekarang</a></p>
        </div>
    </div>
</div>
@endsection
