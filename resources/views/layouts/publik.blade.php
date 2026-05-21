<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Birthday Surprise untuk {{ $pengaturan['nama_penerima'] ?? 'Tersayang' }} dari {{ $pengaturan['nama_pengirim'] ?? '' }}">
    <title>🎂 Happy Birthday — {{ $pengaturan['nama_penerima'] ?? 'Tersayang' }}</title>

    {{-- Google Fonts: Playfair Display + Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Inter:wght@300;400;500;600&family=Handlee&family=Roboto:wght@300;400&display=swap" rel="stylesheet">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        // Konfigurasi tema Tailwind
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'body': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'fade-up': 'fadeUp 0.8s ease forwards',
                        'fade-out': 'fadeOut 0.6s ease forwards',
                        'fade-in': 'fadeIn 0.8s ease forwards',
                        'slide-up': 'slideUp 0.8s ease forwards',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'glow-pulse': 'glowPulse 2s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-15px)' },
                        },
                        fadeUp: {
                            'from': { opacity: '0', transform: 'translateY(30px)' },
                            'to': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeOut: {
                            'from': { opacity: '1', transform: 'scale(1)' },
                            'to': { opacity: '0', transform: 'scale(0.95)' },
                        },
                        fadeIn: {
                            'from': { opacity: '0' },
                            'to': { opacity: '1' },
                        },
                        slideUp: {
                            'from': { opacity: '0', transform: 'translateY(40px)' },
                            'to': { opacity: '1', transform: 'translateY(0)' },
                        },
                        glowPulse: {
                            '0%, 100%': { boxShadow: '0 0 5px var(--c2), 0 0 20px var(--c2)' },
                            '50%': { boxShadow: '0 0 15px var(--c2), 0 0 40px var(--c2)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Tema warna dinamis dari pengaturan */
        :root {
            @php
                $tema = $pengaturan['tema_warna'] ?? 'pink';
                $temaVars = [
                    'pink'      => '--c1:#f472b6;--c2:#ec4899;--c3:#db2777;--c4:#fce7f3;--c5:#831843;',
                    'purple'    => '--c1:#c084fc;--c2:#a855f7;--c3:#9333ea;--c4:#f3e8ff;--c5:#581c87;',
                    'merah_gold'=> '--c1:#f87171;--c2:#ef4444;--c3:#fbbf24;--c4:#fef3c7;--c5:#7f1d1d;',
                    'biru_mint' => '--c1:#67e8f9;--c2:#22d3ee;--c3:#0891b2;--c4:#ecfeff;--c5:#164e63;',
                ];
                echo $temaVars[$tema] ?? $temaVars['pink'];
            @endphp
        }

        body { font-family: 'Inter', sans-serif; background: var(--c4); }
        .font-display { font-family: 'Playfair Display', serif; }

        /* Warna tema dinamis */
        .bg-tema-1 { background-color: var(--c1); }
        .bg-tema-2 { background-color: var(--c2); }
        .bg-tema-3 { background-color: var(--c3); }
        .bg-tema-4 { background-color: var(--c4); }
        .text-tema-2 { color: var(--c2); }
        .text-tema-3 { color: var(--c3); }
        .text-tema-5 { color: var(--c5); }
        .border-tema-2 { border-color: var(--c2); }
        .ring-tema-2 { --tw-ring-color: var(--c2); }

        /* Gradient background */
        .bg-gradient-tema {
            background: linear-gradient(135deg, var(--c4) 0%, white 40%, var(--c4) 100%);
        }

        /* Scrollbar tipis */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--c4); }
        ::-webkit-scrollbar-thumb { background: var(--c2); border-radius: 2px; }

        /* ========== Kertas Buku Bergaris (Notebook Paper) ========== */
        .paper {
            font-family: 'Roboto', sans-serif;
            position: relative;
            width: 92%;
            max-width: 600px;
            min-width: 280px;
            min-height: 420px;
            margin: 0 auto;
            background: #fafafa;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,.15), 0 2px 8px rgba(0,0,0,.1);
            overflow: hidden;
        }

        /* Lubang spiral & garis merah vertikal */
        .paper:before {
            content: '';
            position: absolute;
            top: 0; bottom: 0; left: 5px;
            width: 45px;
            background: radial-gradient(#616161 6px, transparent 7px) repeat-y;
            background-size: 30px 30px;
            border-right: 3px solid var(--c2, #D44147);
            box-sizing: border-box;
            z-index: 2;
        }

        /* Area konten bergaris biru */
        .paper-content {
            position: relative;
            padding: 30px 20px 30px 58px;
            background: linear-gradient(transparent, transparent 28px, #b8e6e8 28px);
            background-size: 30px 30px;
            min-height: 420px;
        }

        /* Teks surat tulisan tangan */
        .paper-content .teks-surat {
            text-align: left;
            width: 100%;
            line-height: 30px;
            padding: 0 8px;
            background: transparent;
            color: #3f3f44;
            font-family: 'Handlee', cursive;
            font-size: 17px;
            box-sizing: border-box;
            z-index: 1;
            position: relative;
        }

        /* Tanda tangan pengirim */
        .tanda-tangan {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: var(--c3, #db2777);
            font-size: 1.1rem;
            margin-top: 20px;
            text-align: right;
            padding-right: 15px;
            opacity: 0;
            transition: opacity 0.8s ease;
        }
        .tanda-tangan.tampil { opacity: 1; }

        /* TypeIt kursor warna tema */
        .ti-cursor { color: var(--c2, #ec4899); }

        /* Tombol Buka Surat animasi glow */
        .btn-buka-surat {
            transition: all 0.3s ease;
        }
        .btn-buka-surat:hover {
            transform: scale(1.05);
            filter: brightness(1.1);
        }
    </style>

    {{-- CDN TypeIt untuk animasi mengetik --}}
    <script src="https://cdn.jsdelivr.net/npm/typeit@7.0.4/dist/typeit.min.js"></script>
</head>
<body class="bg-gradient-tema min-h-screen">

    @yield('content')

</body>
</html>
