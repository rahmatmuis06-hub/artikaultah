@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')

<h1 class="text-2xl font-bold text-gray-900 mb-1">Buat akun baru ✨</h1>
<p class="text-gray-500 text-sm mb-8">Daftar gratis dan mulai dalam hitungan menit.</p>

<form method="POST" action="{{ route('register') }}" class="space-y-5">
    @csrf

    {{-- Name --}}
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
            placeholder="Nama lengkap kamu"
            class="w-full px-4 py-3 rounded-xl border @error('name') border-red-400 bg-red-50 @else border-gray-200 @enderror
                   focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
        @error('name')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required
            placeholder="email@kamu.com"
            class="w-full px-4 py-3 rounded-xl border @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror
                   focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
        @error('email')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
        <input id="password" type="password" name="password" required
            placeholder="Minimal 8 karakter"
            class="w-full px-4 py-3 rounded-xl border @error('password') border-red-400 bg-red-50 @else border-gray-200 @enderror
                   focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
        @error('password')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
            placeholder="Ulangi kata sandi"
            class="w-full px-4 py-3 rounded-xl border border-gray-200
                   focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition text-sm">
    </div>

    {{-- Terms --}}
    <div class="flex items-start gap-2">
        <input type="checkbox" id="terms" name="terms" required class="w-4 h-4 mt-0.5 rounded accent-sky-600">
        <label for="terms" class="text-sm text-gray-600">
            Saya setuju dengan
            <a href="#" class="text-sky-600 hover:underline">Syarat & Ketentuan</a>
            dan
            <a href="#" class="text-sky-600 hover:underline">Kebijakan Privasi</a>
        </label>
    </div>

    {{-- Submit --}}
    <button type="submit"
        class="w-full py-3 rounded-xl bg-sky-600 text-white font-semibold hover:bg-sky-700 transition shadow-md text-sm">
        Buat Akun Gratis
    </button>
</form>

<p class="text-center text-sm text-gray-500 mt-6">
    Sudah punya akun?
    <a href="{{ route('login') }}" class="text-sky-600 font-semibold hover:underline">Masuk di sini</a>
</p>

@endsection
