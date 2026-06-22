<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Istana Pasir Cilegon') - Wisata Pemesanan Tiket</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine JS or Custom JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen">
    @yield('content')
    @yield('scripts')
</body>
</html>
