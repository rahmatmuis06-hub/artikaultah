<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Artikaultah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .bg-birthday {
            background: linear-gradient(135deg, #fce7f3 0%, #f5f3ff 50%, #fce7f3 100%);
            min-height: 100vh;
        }
        .card-glass {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(249,168,212,0.3);
        }
        .btn-login {
            background: linear-gradient(135deg, #ec4899, #a855f7);
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #db2777, #9333ea);
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(236,72,153,0.4);
        }
        .input-field {
            transition: all 0.3s ease;
            border: 2px solid #fce7f3;
        }
        .input-field:focus {
            border-color: #ec4899;
            box-shadow: 0 0 0 4px rgba(236,72,153,0.1);
            outline: none;
        }
        .particle {
            position: absolute;
            border-radius: 50%;
            animation: float-particle linear infinite;
            opacity: 0.6;
        }
        @keyframes float-particle {
            0%   { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10%  { opacity: 0.6; }
            90%  { opacity: 0.6; }
            100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
        }
    </style>
</head>
<body class="bg-birthday flex items-center justify-center relative overflow-hidden">

    {{-- Partikel dekoratif --}}
    @for ($i = 0; $i < 12; $i++)
    <div class="particle"
         style="
            width: {{ rand(6,18) }}px;
            height: {{ rand(6,18) }}px;
            left: {{ rand(0,100) }}%;
            bottom: -50px;
            background: {{ ['#f9a8d4','#c084fc','#fb7185','#fbbf24','#67e8f9'][array_rand(['#f9a8d4','#c084fc','#fb7185','#fbbf24','#67e8f9'])] }};
            animation-duration: {{ rand(8,20) }}s;
            animation-delay: {{ rand(0,10) }}s;
         ">
    </div>
    @endfor

    {{-- Lingkaran dekoratif latar --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 translate-x-1/2 translate-y-1/2"></div>

    {{-- Card Login --}}
    <div class="card-glass rounded-3xl shadow-2xl p-10 w-full max-w-md mx-4 relative z-10">

        {{-- Logo / Judul --}}
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-pink-400 to-purple-500 rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <span class="text-4xl">🎂</span>
            </div>
            <h1 class="font-display text-3xl font-bold text-gray-800 mb-1">Admin Panel</h1>
            <p class="text-gray-500 text-sm">Artikaultah Birthday System</p>
        </div>

        {{-- Pesan Error --}}
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl px-4 py-3 mb-6 flex items-center gap-2 text-sm">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            {{ $errors->first() }}
        </div>
        @endif

        {{-- Form Login --}}
        <form action="{{ route('admin.prosesLogin') }}" method="POST" id="form-login">
            @csrf
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Admin</label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password..."
                        autocomplete="current-password"
                        class="input-field w-full rounded-xl px-4 py-3 text-gray-800 text-sm bg-white"
                    >
                    <button type="button" id="toggle-password"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pink-500 transition-colors"
                        onclick="togglePassword()">
                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" id="btn-submit"
                class="btn-login w-full text-white font-semibold py-3 rounded-xl text-sm">
                Masuk ke Dashboard
            </button>
        </form>

        {{-- Link ke halaman publik --}}
        <div class="text-center mt-6">
            <a href="{{ route('publik.index') }}" class="text-sm text-gray-400 hover:text-pink-500 transition-colors inline-flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Lihat Halaman Publik
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        // Loading state saat submit
        document.getElementById('form-login').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            btn.textContent = 'Memproses...';
            btn.disabled = true;
        });
    </script>
</body>
</html>
