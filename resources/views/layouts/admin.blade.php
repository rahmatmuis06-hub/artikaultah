<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel — Artikaultah</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'body': ['Inter', 'sans-serif'],
                        'display': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .scrollbar-thin::-webkit-scrollbar { width: 4px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: #f1f5f9; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #f9a8d4; border-radius: 4px; }
        .tab-btn.active { background: linear-gradient(135deg, #ec4899, #a855f7); color: white; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .sortable-ghost { opacity: 0.4; background: #fce7f3; }
        .drag-handle { cursor: grab; }
        .drag-handle:active { cursor: grabbing; }
        input[type=range]::-webkit-slider-thumb { background: #ec4899; }
        .toast {
            position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 9999;
            transform: translateX(150%);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .toast.show { transform: translateX(0); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

@yield('content')

{{-- Toast Notification --}}
<div id="toast" class="toast bg-white rounded-2xl shadow-2xl border border-pink-100 px-6 py-4 flex items-center gap-3 min-w-64">
    <div id="toast-icon" class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
        </svg>
    </div>
    <p id="toast-msg" class="text-sm font-medium text-gray-700"></p>
</div>

<script>
    // ====== Toast Notification Helper ======
    function tampilkanToast(pesan, tipe = 'sukses') {
        const toast = document.getElementById('toast');
        const icon  = document.getElementById('toast-icon');
        const msg   = document.getElementById('toast-msg');
        msg.textContent = pesan;
        if (tipe === 'sukses') {
            icon.className = 'w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 bg-green-100 text-green-600';
        } else {
            icon.className = 'w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 bg-red-100 text-red-600';
            icon.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>';
        }
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3500);
    }

    // ====== Tab Navigation ======
    function bukaTab(nama) {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelector('[data-tab="' + nama + '"]').classList.add('active');
        document.getElementById('tab-' + nama).classList.add('active');
        localStorage.setItem('activeTab', nama);
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Restore tab dari localStorage
        const activeTab = localStorage.getItem('activeTab') || 'identitas';
        bukaTab(activeTab);

        @if(session('sukses'))
            tampilkanToast("{{ session('sukses') }}", 'sukses');
        @endif
        @if($errors->any())
            tampilkanToast("{{ $errors->first() }}", 'gagal');
        @endif
    });
</script>

@yield('scripts')
</body>
</html>
