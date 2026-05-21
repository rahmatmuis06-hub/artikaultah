@extends('layouts.publik')

@section('content')

{{-- Musik Latar (Opsional) --}}
@php
    $musikPath = $pengaturan['musik_latar'] ?? null;
    $musikUrl  = $musikPath ? \Illuminate\Support\Facades\Storage::url($musikPath) : null;
    $adaMusik  = $musikUrl && ($pengaturan['putar_otomatis'] ?? 'false') == 'true';
@endphp
@if($adaMusik)
<audio id="bg-music" loop preload="auto">
    <source src="{{ $musikUrl }}" type="audio/mpeg">
</audio>
@endif

<div class="relative w-full max-w-lg mx-auto min-h-screen bg-white shadow-2xl overflow-hidden pb-20">
    
    {{-- Decorative Background --}}
    <div class="absolute top-0 left-0 w-full h-64 bg-tema-4 rounded-b-[50%] scale-150 transform -translate-y-20 z-0"></div>
    <div class="absolute top-10 right-10 w-20 h-20 bg-tema-2 opacity-20 rounded-full blur-2xl"></div>
    <div class="absolute top-40 left-10 w-32 h-32 bg-tema-3 opacity-20 rounded-full blur-3xl"></div>

    <div class="relative z-10 px-6 pt-16 text-center">
        
        {{-- Hero Section --}}
        <div class="animate-fade-up">
            <p class="text-tema-3 font-semibold tracking-widest text-sm uppercase mb-2">Happy Birthday</p>
            <h1 class="font-display text-5xl font-bold text-gray-800 mb-4 leading-tight">
                {{ $pengaturan['nama_penerima'] ?? 'Tersayang' }}
            </h1>
            <div class="inline-block px-4 py-1 bg-tema-1 text-white rounded-full text-sm font-medium mb-8 shadow-lg shadow-pink-200">
                {{ $pengaturan['tanggal_lahir'] ?? '01/06' }}
            </div>
        </div>

        {{-- Countdown (Jika belum ultah) --}}
        @if(!$countdown['sudah_ultah'])
        <div class="bg-white/80 backdrop-blur rounded-3xl p-6 shadow-xl border border-tema-4 animate-fade-up" style="animation-delay: 0.2s;">
            <p class="text-sm text-gray-500 mb-4">Menghitung mundur menuju hari spesialmu...</p>
            <div class="flex justify-center gap-4 text-center" id="countdown-timer" data-target="{{ $countdown['tanggal_ultah'] }}">
                <div class="w-16"><div class="text-3xl font-bold text-tema-2" id="cd-days">00</div><div class="text-xs text-gray-400">Hari</div></div>
                <div class="w-16"><div class="text-3xl font-bold text-tema-2" id="cd-hours">00</div><div class="text-xs text-gray-400">Jam</div></div>
                <div class="w-16"><div class="text-3xl font-bold text-tema-2" id="cd-mins">00</div><div class="text-xs text-gray-400">Menit</div></div>
                <div class="w-16"><div class="text-3xl font-bold text-tema-2" id="cd-secs">00</div><div class="text-xs text-gray-400">Detik</div></div>
            </div>
        </div>
        @else
        {{-- Pesta (Jika hari ini) --}}
        <div class="bg-white/80 backdrop-blur rounded-3xl p-8 shadow-xl border border-tema-4 animate-fade-up flex flex-col items-center justify-center" style="animation-delay: 0.2s;">
            <div class="text-6xl mb-4 animate-bounce">🎂</div>
            <h2 class="font-display text-2xl font-bold text-tema-3 mb-2">Hari Ini Hari Spesialmu!</h2>
            <p class="text-gray-600">Selamat ulang tahun! Mari rayakan bersama 🎉</p>
        </div>
        @endif

        {{-- Pesan Utama --}}
        <div class="mt-12 text-left animate-fade-up" style="animation-delay: 0.4s;">
            <div class="relative bg-tema-4 rounded-3xl p-8 rounded-tl-none">
                <svg class="absolute -top-4 -left-2 w-8 h-8 text-tema-4 transform rotate-180" fill="currentColor" viewBox="0 0 24 24"><path d="M24 0v24H0c13.255 0 24-10.745 24-24z"/></svg>
                <p class="text-gray-700 leading-relaxed font-medium text-lg italic font-display">
                    "{{ $pengaturan['pesan_utama'] ?? 'Semoga sehat selalu dan panjang umur.' }}"
                </p>
                <div class="mt-6 text-right">
                    <p class="text-sm text-gray-500">Dari yang menyayangimu,</p>
                    <p class="font-bold text-tema-3 text-xl font-display">{{ $pengaturan['nama_pengirim'] ?? '' }}</p>
                </div>
            </div>
        </div>

        {{-- Harapan & Doa --}}
        @if($harapans->count() > 0)
        <div class="mt-16 text-left">
            <h3 class="font-display text-2xl font-bold text-gray-800 mb-6 text-center">Harapan & Doa</h3>
            <div class="space-y-4">
                @foreach($harapans as $index => $h)
                <div class="flex gap-4 items-start animate-fade-up opacity-0" style="animation-delay: {{ 0.5 + ($index * 0.1) }}s; animation-fill-mode: forwards;">
                    <div class="w-8 h-8 rounded-full bg-tema-2 text-white flex items-center justify-center flex-shrink-0 font-bold shadow-md shadow-pink-200">{{ $index + 1 }}</div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm flex-1">
                        <p class="text-gray-700">{{ $h->isi }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Galeri Foto --}}
        @if($fotos->count() > 0)
        <div class="mt-16">
            <h3 class="font-display text-2xl font-bold text-gray-800 mb-6">Momen Bersama</h3>
            <div class="columns-2 gap-4 space-y-4">
                @foreach($fotos as $f)
                <div class="break-inside-avoid rounded-2xl overflow-hidden shadow-md">
                    <img src="{{ $f->url }}" class="w-full h-auto" loading="lazy">
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Galeri Video --}}
        @if($videos->count() > 0)
        <div class="mt-16">
            <h3 class="font-display text-2xl font-bold text-gray-800 mb-6">Video Spesial</h3>
            <div class="space-y-6">
                @foreach($videos as $v)
                <div class="rounded-3xl overflow-hidden shadow-lg bg-black aspect-video relative">
                    <video src="{{ $v->url }}" class="w-full h-full object-cover" controls preload="metadata"></video>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

{{-- Tombol Play Music --}}
@if($adaMusik)
<button id="btn-music" class="fixed bottom-6 right-6 w-14 h-14 bg-tema-2 text-white rounded-full shadow-xl shadow-pink-300 flex items-center justify-center z-50 transition hover:scale-110">
    <svg id="icon-play" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
    <svg id="icon-pause" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const audio = document.getElementById('bg-music');
        const btn = document.getElementById('btn-music');
        const iconPlay = document.getElementById('icon-play');
        const iconPause = document.getElementById('icon-pause');
        let isPlaying = false;

        // Auto play saat interaksi pertama
        const playAudio = () => {
            if(!isPlaying) {
                audio.play().then(() => {
                    isPlaying = true;
                    iconPlay.classList.add('hidden');
                    iconPause.classList.remove('hidden');
                }).catch(() => {});
                document.removeEventListener('click', playAudio);
            }
        };
        document.addEventListener('click', playAudio);

        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (isPlaying) {
                audio.pause();
                iconPlay.classList.remove('hidden');
                iconPause.classList.add('hidden');
            } else {
                audio.play();
                iconPlay.classList.add('hidden');
                iconPause.classList.remove('hidden');
            }
            isPlaying = !isPlaying;
        });
    });
</script>
@endif

{{-- Script Countdown --}}
@if(!$countdown['sudah_ultah'])
<script>
    const timerEl = document.getElementById('countdown-timer');
    const targetDate = new Date(timerEl.dataset.target).getTime();

    const interval = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            clearInterval(interval);
            location.reload(); // Refresh halaman jika sudah ultah
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('cd-days').innerText = days.toString().padStart(2, '0');
        document.getElementById('cd-hours').innerText = hours.toString().padStart(2, '0');
        document.getElementById('cd-mins').innerText = minutes.toString().padStart(2, '0');
        document.getElementById('cd-secs').innerText = seconds.toString().padStart(2, '0');
    }, 1000);
</script>
@endif

@if($countdown['sudah_ultah'])
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
    // Confetti saat halaman dimuat jika sudah ultah
    window.addEventListener('load', () => {
        const duration = 3000;
        const end = Date.now() + duration;

        (function frame() {
            confetti({
                particleCount: 5,
                angle: 60,
                spread: 55,
                origin: { x: 0 },
                colors: ['#f472b6', '#a855f7', '#fbbf24']
            });
            confetti({
                particleCount: 5,
                angle: 120,
                spread: 55,
                origin: { x: 1 },
                colors: ['#f472b6', '#a855f7', '#fbbf24']
            });

            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        }());
    });
</script>
@endif

@endsection
