@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<section class="min-h-screen flex items-center pt-20 bg-gradient-to-br from-sky-50 via-white to-indigo-50">
    <div class="max-w-7xl mx-auto px-6 py-20 text-center">
        <span class="inline-block px-4 py-1.5 rounded-full bg-sky-100 text-sky-700 text-sm font-medium mb-6">
            🚀 Selamat datang di platform kami
        </span>
        <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
            Solusi Digital <br>
            <span class="text-sky-600">Untuk Semua Kebutuhan</span>
        </h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-10 leading-relaxed">
            Platform modern yang membantu kamu bekerja lebih efisien, kolaborasi lebih mudah, dan tumbuh lebih cepat.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}"
               class="btn-primary px-8 py-4 rounded-xl bg-sky-600 text-white font-semibold text-lg hover:bg-sky-700 shadow-lg hover:shadow-sky-200 transform hover:-translate-y-0.5">
                Mulai Gratis
            </a>
            <a href="#features"
               class="px-8 py-4 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold text-lg hover:border-sky-300 hover:text-sky-600 transition">
                Lihat Fitur →
            </a>
        </div>

        {{-- Stats --}}
        <div class="mt-20 grid grid-cols-3 gap-8 max-w-lg mx-auto">
            <div>
                <p class="text-3xl font-bold text-gray-900">10K+</p>
                <p class="text-sm text-gray-500 mt-1">Pengguna</p>
            </div>
            <div class="border-x border-gray-200">
                <p class="text-3xl font-bold text-gray-900">99%</p>
                <p class="text-sm text-gray-500 mt-1">Uptime</p>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-900">24/7</p>
                <p class="text-sm text-gray-500 mt-1">Dukungan</p>
            </div>
        </div>
    </div>
</section>

{{-- Features Section --}}
<section id="features" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
            <p class="text-gray-500 text-lg max-w-xl mx-auto">Semua yang kamu butuhkan tersedia dalam satu platform yang terintegrasi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $features = [
                ['icon' => '⚡', 'title' => 'Super Cepat', 'desc' => 'Performa tinggi dengan teknologi terkini untuk pengalaman yang mulus.'],
                ['icon' => '🔒', 'title' => 'Aman & Terlindungi', 'desc' => 'Keamanan data kamu adalah prioritas utama kami dengan enkripsi tingkat tinggi.'],
                ['icon' => '📊', 'title' => 'Analitik Lengkap', 'desc' => 'Pantau semua aktivitas dengan dashboard analitik yang mudah dipahami.'],
                ['icon' => '🤝', 'title' => 'Kolaborasi Tim', 'desc' => 'Bekerja bersama tim dengan fitur kolaborasi real-time yang canggih.'],
                ['icon' => '🌐', 'title' => 'Multi Platform', 'desc' => 'Dapat diakses dari mana saja melalui web, mobile, dan desktop.'],
                ['icon' => '🎯', 'title' => 'Mudah Digunakan', 'desc' => 'Antarmuka yang intuitif sehingga langsung bisa digunakan tanpa pelatihan.'],
            ];
            @endphp

            @foreach($features as $feature)
            <div class="p-8 rounded-2xl border border-gray-100 hover:border-sky-200 hover:shadow-lg transition-all duration-300 group">
                <span class="text-4xl block mb-4">{{ $feature['icon'] }}</span>
                <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-sky-600 transition">{{ $feature['title'] }}</h3>
                <p class="text-gray-500 leading-relaxed">{{ $feature['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-24 bg-sky-600">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-white mb-4">Siap untuk memulai?</h2>
        <p class="text-sky-100 text-lg mb-10">Daftar sekarang dan nikmati semua fitur secara gratis selama 30 hari.</p>
        <a href="{{ route('register') }}"
           class="inline-block px-10 py-4 rounded-xl bg-white text-sky-600 font-bold text-lg hover:bg-sky-50 transition shadow-xl">
            Daftar Sekarang — Gratis!
        </a>
    </div>
</section>

{{-- About Section --}}
<section id="about" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Tentang Kami</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Kami adalah tim yang berdedikasi untuk membangun solusi digital terbaik bagi bisnis dan individu di Indonesia.
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Dengan pengalaman lebih dari 5 tahun, kami telah membantu ribuan pengguna mencapai tujuan mereka dengan teknologi yang tepat guna.
                </p>
                <a href="#contact" class="inline-flex items-center gap-2 text-sky-600 font-semibold hover:underline">
                    Hubungi kami →
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <p class="text-3xl font-bold text-sky-600">5+</p>
                    <p class="text-gray-500 text-sm mt-1">Tahun Pengalaman</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <p class="text-3xl font-bold text-sky-600">50+</p>
                    <p class="text-gray-500 text-sm mt-1">Tim Profesional</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <p class="text-3xl font-bold text-sky-600">100+</p>
                    <p class="text-gray-500 text-sm mt-1">Proyek Selesai</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <p class="text-3xl font-bold text-sky-600">4.9⭐</p>
                    <p class="text-gray-500 text-sm mt-1">Rating Pengguna</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Contact Section --}}
<section id="contact" class="py-24 bg-white">
    <div class="max-w-2xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
        <p class="text-gray-500 mb-10">Ada pertanyaan? Kami siap membantu kamu.</p>

        <form action="#" method="POST" class="space-y-4 text-left">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="name" placeholder="Nama lengkap kamu"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" placeholder="email@kamu.com"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                <textarea name="message" rows="4" placeholder="Tulis pesanmu di sini..."
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition resize-none"></textarea>
            </div>
            <button type="submit"
                class="w-full py-4 rounded-xl bg-sky-600 text-white font-semibold text-lg hover:bg-sky-700 transition shadow-md">
                Kirim Pesan
            </button>
        </form>
    </div>
</section>

@endsection
