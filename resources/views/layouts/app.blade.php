<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyApp') }} - @yield('title', 'Home')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50:  '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        .nav-link { transition: color 0.2s; }
        .btn-primary { transition: all 0.2s; }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased text-gray-800 bg-white">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold text-xl text-sky-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                {{ config('app.name', 'MyApp') }}
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
                <a href="#features" class="nav-link hover:text-sky-600">Fitur</a>
                <a href="#about" class="nav-link hover:text-sky-600">Tentang</a>
                <a href="#contact" class="nav-link hover:text-sky-600">Kontak</a>
            </div>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-3">
                @auth
                    <span class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-sky-600 font-medium transition">Masuk</a>
                    <a href="{{ route('register') }}" class="text-sm px-4 py-2 rounded-lg bg-sky-600 text-white hover:bg-sky-700 transition shadow-sm">
                        Daftar Gratis
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-white font-semibold text-lg mb-3">{{ config('app.name', 'MyApp') }}</h3>
                    <p class="text-sm leading-relaxed">Solusi terbaik untuk kebutuhan digital kamu. Mudah, cepat, dan terpercaya.</p>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-3">Tautan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#features" class="hover:text-white transition">Fitur</a></li>
                        <li><a href="#about" class="hover:text-white transition">Tentang</a></li>
                        <li><a href="#contact" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-3">Akun</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition">Daftar</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 text-center text-sm">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'MyApp') }}. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
