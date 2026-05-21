@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')

<h1 class="text-2xl font-bold text-gray-900 mb-1">Selamat datang kembali 👋</h1>
<p class="text-gray-500 text-sm mb-8">Masuk ke akun kamu untuk melanjutkan.</p>

{{-- Session Status --}}
@if (session('status'))
    <div class="mb-4 px-4 py-3 rounded-lg bg-green-50 text-green-700 text-sm border border-green-200">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

    {{-- Email --}}
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
            placeholder="email@kamu.com"
            class="w-full px-4 py-3 rounded-xl border @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror
                   focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
        @error('email')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div>
        <div class="flex items-center justify-between mb-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs text-sky-600 hover:underline">Lupa sandi?</a>
            @endif
        </div>
        <input id="password" type="password" name="password" required
            placeholder="••••••••"
            class="w-full px-4 py-3 rounded-xl border @error('password') border-red-400 bg-red-50 @else border-gray-200 @enderror
                   focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
        @error('password')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Remember Me --}}
    <div class="flex items-center gap-2">
        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded accent-sky-600">
        <label for="remember" class="text-sm text-gray-600">Ingat saya</label>
    </div>

    {{-- Submit --}}
    <button type="submit"
        class="w-full py-3 rounded-xl bg-sky-600 text-white font-semibold hover:bg-sky-700 transition shadow-md text-sm">
        Masuk
    </button>
</form>

<p class="text-center text-sm text-gray-500 mt-6">
    Belum punya akun?
    <a href="{{ route('register') }}" class="text-sky-600 font-semibold hover:underline">Daftar sekarang</a>
</p>

@endsection
