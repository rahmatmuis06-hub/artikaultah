<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyApp') }} - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-sky-50 via-white to-indigo-50 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 font-bold text-2xl text-sky-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                {{ config('app.name', 'MyApp') }}
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
            @yield('content')
        </div>

        {{-- Back to home --}}
        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-sky-600 transition">← Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
