@extends('layouts.guest')

@section('title', 'Registrasi Pengunjung')

@section('guest-content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-sky-50 via-white to-amber-50 px-4 py-12">
    <div class="w-full max-w-xl">
        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-xl border border-white p-8 sm:p-10">
            <div class="text-center space-y-2">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 font-black text-slate-900 text-xl"><span class="p-2 rounded-xl bg-gradient-to-tr from-amber-500 to-sky-500 text-white">🏰</span> Istana Pasir</a>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Akun Pengunjung</h2>
                <p class="text-sm text-slate-500">Mulai petualangan Anda dengan membuat akun.</p>
            </div>
            @if ($errors->any())<div class="mt-6 p-3 rounded-xl bg-rose-50 text-rose-700 text-sm font-semibold">{{ $errors->first() }}</div>@endif

            <form class="mt-8 space-y-5" action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Nama Lengkap</label>
                        <input id="name" name="name" value="{{ old('name') }}" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 bg-slate-50/50" placeholder="Nama lengkap">
                    </div>
                    <div class="space-y-1.5"><label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Username</label><input name="username" value="{{ old('username') }}" class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 bg-slate-50/50" placeholder="username unik"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5"><label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Email</label><input type="email" name="email" value="{{ old('email') }}" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 bg-slate-50/50" placeholder="nama@email.com"></div>
                    <div class="space-y-1.5"><label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">No. WhatsApp</label><input name="phone" value="{{ old('phone') }}" class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 bg-slate-50/50" placeholder="08123456789"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5"><label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Password</label><input type="password" name="password" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 bg-slate-50/50" placeholder="Minimal 6 karakter"></div>
                    <div class="space-y-1.5"><label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Konfirmasi Password</label><input type="password" name="password_confirmation" required class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 bg-slate-50/50" placeholder="Ulangi password"></div>
                </div>
                <button type="submit" class="w-full py-3.5 px-6 bg-gradient-to-r from-sky-500 to-amber-500 hover:from-sky-600 hover:to-amber-600 text-white rounded-xl text-sm font-bold shadow-lg transition-all">Buat Akun</button>
            </form>
            <p class="mt-6 text-center text-sm text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-amber-600 hover:text-amber-700">Login</a></p>
        </div>
    </div>
</div>

<script>
    document.getElementById('name').addEventListener('input', function (e) {
        // Hanya mengizinkan huruf, spasi, titik (.), dan koma (,) biasanya untuk gelar
        // Menghapus angka dan simbol aneh secara otomatis saat diketik atau di-paste
        this.value = this.value.replace(/[^a-zA-Z\s.,']/g, '');
    });
</script>
@endsection
