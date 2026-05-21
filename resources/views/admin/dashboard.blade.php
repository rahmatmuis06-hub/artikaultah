@extends('layouts.admin')

@section('content')
<div class="flex h-screen overflow-hidden">
    {{-- Sidebar --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-gray-200">
            <span class="text-2xl mr-2">🎂</span>
            <h1 class="font-display text-xl font-bold text-gray-800 tracking-tight">Admin<span class="text-pink-500">Ultah</span></h1>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto scrollbar-thin">
            <button data-tab="identitas" onclick="bukaTab('identitas')" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-pink-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Pengaturan Utama
            </button>
            <button data-tab="harapan" onclick="bukaTab('harapan')" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-pink-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Daftar Harapan
            </button>
            <button data-tab="foto" onclick="bukaTab('foto')" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-pink-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Galeri Foto
            </button>
            <button data-tab="video" onclick="bukaTab('video')" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-medium hover:bg-pink-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                Galeri Video
            </button>
        </nav>
        <div class="p-4 border-t border-gray-200 space-y-2">
            <a href="{{ route('publik.index') }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-pink-100 text-pink-700 rounded-xl hover:bg-pink-200 transition text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Lihat Website
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50/50">
        <header class="h-16 flex items-center justify-between px-8 bg-white border-b border-gray-200 md:hidden shrink-0">
            <div class="flex items-center gap-2">
                <span class="text-2xl">🎂</span>
                <h1 class="font-display text-xl font-bold">Admin<span class="text-pink-500">Ultah</span></h1>
            </div>
            <button class="text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-4 md:p-8 scrollbar-thin">
            <div class="max-w-5xl mx-auto">

                {{-- Tab: Identitas --}}
                <div id="tab-identitas" class="tab-content">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-lg font-bold text-gray-800">Pengaturan Utama</h2>
                            <p class="text-sm text-gray-500">Atur informasi dasar untuk halaman kejutan</p>
                        </div>
                        <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="p-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penerima</label>
                                    <input type="text" name="nama_penerima" value="{{ $pengaturan['nama_penerima'] ?? '' }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 transition px-4 py-2 border">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengirim</label>
                                    <input type="text" name="nama_pengirim" value="{{ $pengaturan['nama_pengirim'] ?? '' }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 transition px-4 py-2 border">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir (DD/MM)</label>
                                    <input type="text" name="tanggal_lahir" value="{{ $pengaturan['tanggal_lahir'] ?? '' }}" placeholder="Contoh: 01/06" required pattern="\d{2}/\d{2}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 transition px-4 py-2 border">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tema Warna</label>
                                    <select name="tema_warna" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 transition px-4 py-2 border">
                                        <option value="pink" {{ ($pengaturan['tema_warna'] ?? '') == 'pink' ? 'selected' : '' }}>Pink (Default)</option>
                                        <option value="purple" {{ ($pengaturan['tema_warna'] ?? '') == 'purple' ? 'selected' : '' }}>Purple</option>
                                        <option value="merah_gold" {{ ($pengaturan['tema_warna'] ?? '') == 'merah_gold' ? 'selected' : '' }}>Merah & Gold</option>
                                        <option value="biru_mint" {{ ($pengaturan['tema_warna'] ?? '') == 'biru_mint' ? 'selected' : '' }}>Biru Mint</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pesan Utama</label>
                                <textarea name="pesan_utama" rows="4" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 transition px-4 py-2 border">{{ $pengaturan['pesan_utama'] ?? '' }}</textarea>
                            </div>
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="putar_otomatis" id="putar_otomatis" {{ ($pengaturan['putar_otomatis'] ?? '') == 'true' ? 'checked' : '' }} class="w-5 h-5 text-pink-500 rounded border-gray-300 focus:ring-pink-500">
                                <label for="putar_otomatis" class="text-sm text-gray-700">Putar musik secara otomatis saat halaman dibuka</label>
                            </div>
                            {{-- Musik Latar --}}
                            <div class="border-t border-gray-100 pt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">🎵 Musik Latar (mp3/wav/ogg, maks 15MB)</label>
                                @if(!empty($pengaturan['musik_latar']))
                                <div class="bg-pink-50 rounded-xl p-4 mb-3 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-pink-200 rounded-xl flex items-center justify-center text-pink-600">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Lagu aktif</p>
                                            <audio controls class="h-8 mt-1">
                                                <source src="{{ \Illuminate\Support\Facades\Storage::url($pengaturan['musik_latar']) }}" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>
                                    <span class="text-xs text-pink-500 font-medium">✓ Terpasang</span>
                                </div>
                                @endif
                                <input type="file" name="musik_latar" accept=".mp3,.wav,.ogg" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 transition">
                                <p class="text-xs text-gray-400 mt-1">Unggah file baru untuk mengganti lagu saat ini</p>
                            </div>

                            <div class="pt-4 flex justify-end">
                                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-pink-500 to-purple-500 text-white font-medium rounded-xl shadow-lg shadow-pink-500/30 hover:shadow-pink-500/50 hover:-translate-y-0.5 transition-all">
                                    Simpan Pengaturan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Tab: Harapan --}}
                <div id="tab-harapan" class="tab-content">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-bold text-gray-800">Daftar Harapan & Doa</h2>
                                <p class="text-sm text-gray-500">Drag & drop ikon titik-titik untuk mengubah urutan</p>
                            </div>
                            <button onclick="document.getElementById('modal-harapan').classList.remove('hidden')" class="px-4 py-2 bg-pink-100 text-pink-700 font-medium rounded-xl hover:bg-pink-200 transition flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Baru
                            </button>
                        </div>
                        <div class="p-2">
                            <ul id="list-harapan" class="space-y-1">
                                @foreach($harapans as $h)
                                <li data-id="{{ $h->id }}" class="group flex items-center justify-between p-3 hover:bg-gray-50 rounded-xl transition border border-transparent hover:border-gray-100">
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="drag-handle p-2 text-gray-300 group-hover:text-gray-500 transition cursor-grab">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 4a2 2 0 11-4 0 2 2 0 014 0zM17 4a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0zM17 10a2 2 0 11-4 0 2 2 0 014 0zM7 16a2 2 0 11-4 0 2 2 0 014 0zM17 16a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-gray-800 font-medium {{ !$h->aktif ? 'line-through text-gray-400' : '' }}">{{ $h->isi }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                        <form action="{{ route('admin.harapan.ubah', $h->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="isi" value="{{ $h->isi }}">
                                            <input type="hidden" name="aktif" value="{{ $h->aktif ? '0' : '1' }}">
                                            <button type="submit" title="{{ $h->aktif ? 'Nonaktifkan' : 'Aktifkan' }}" class="p-2 text-gray-400 hover:text-blue-500 transition rounded-lg hover:bg-blue-50">
                                                @if($h->aktif)
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                @else
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                                @endif
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.harapan.hapus', $h->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus harapan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition rounded-lg hover:bg-red-50">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Tab: Foto & Video --}}
                <div id="tab-foto" class="tab-content">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-bold text-gray-800">Galeri Foto</h2>
                            <label class="cursor-pointer px-4 py-2 bg-pink-100 text-pink-700 font-medium rounded-xl hover:bg-pink-200 transition flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                Unggah Foto
                                <input type="file" id="upload-foto" class="hidden" accept="image/jpeg,image/png,image/webp" multiple>
                            </label>
                        </div>
                        <div id="grid-foto" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($fotos as $f)
                            <div data-id="{{ $f->id }}" class="group relative aspect-square rounded-xl overflow-hidden shadow-sm border border-gray-100">
                                <div class="absolute top-2 left-2 p-1.5 bg-black/50 text-white rounded cursor-grab drag-handle z-10 opacity-0 group-hover:opacity-100 transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M7 4a2 2 0 11-4 0 2 2 0 014 0zM17 4a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0zM17 10a2 2 0 11-4 0 2 2 0 014 0zM7 16a2 2 0 11-4 0 2 2 0 014 0zM17 16a2 2 0 11-4 0 2 2 0 014 0z"/></svg></div>
                                <img src="{{ $f->url }}" class="w-full h-full object-cover">
                                <button onclick="hapusMedia('foto', {{ $f->id }}, this)" class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-lg opacity-0 group-hover:opacity-100 transition hover:bg-red-600 z-10">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="tab-video" class="tab-content">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-bold text-gray-800">Galeri Video</h2>
                            <label class="cursor-pointer px-4 py-2 bg-pink-100 text-pink-700 font-medium rounded-xl hover:bg-pink-200 transition flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                Unggah Video
                                <input type="file" id="upload-video" class="hidden" accept="video/mp4,video/webm">
                            </label>
                        </div>
                        <div id="grid-video" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($videos as $v)
                            <div data-id="{{ $v->id }}" class="group relative aspect-video rounded-xl overflow-hidden shadow-sm border border-gray-100 bg-black">
                                <div class="absolute top-2 left-2 p-1.5 bg-black/50 text-white rounded cursor-grab drag-handle z-10 opacity-0 group-hover:opacity-100 transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M7 4a2 2 0 11-4 0 2 2 0 014 0zM17 4a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0zM17 10a2 2 0 11-4 0 2 2 0 014 0zM7 16a2 2 0 11-4 0 2 2 0 014 0zM17 16a2 2 0 11-4 0 2 2 0 014 0z"/></svg></div>
                                <video src="{{ $v->url }}" class="w-full h-full object-cover" controls preload="metadata"></video>
                                <button onclick="hapusMedia('video', {{ $v->id }}, this)" class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-lg opacity-0 group-hover:opacity-100 transition hover:bg-red-600 z-10">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

{{-- Modal Tambah Harapan --}}
<div id="modal-harapan" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl scale-95 transition-transform">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Harapan</h3>
        <form action="{{ route('admin.harapan.simpan') }}" method="POST">
            @csrf
            <textarea name="isi" rows="3" required placeholder="Tuliskan doa dan harapan..." class="w-full rounded-xl border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 p-3 border mb-4"></textarea>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modal-harapan').classList.add('hidden')" class="px-4 py-2 text-gray-500 hover:bg-gray-100 rounded-xl transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-xl hover:bg-pink-600 transition shadow-lg shadow-pink-500/30">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    // Inisialisasi SortableJS
    function initSortable(elId, url) {
        const el = document.getElementById(elId);
        if(!el) return;
        new Sortable(el, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function () {
                const urutan = Array.from(el.children).map(child => child.dataset.id);
                fetch(url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ urutan })
                }).then(res => res.json()).then(data => {
                    if(data.sukses) tampilkanToast('Urutan berhasil diperbarui');
                });
            }
        });
    }

    initSortable('list-harapan', '{{ route('admin.harapan.urutkan') }}');
    initSortable('grid-foto', '{{ route('admin.foto.urutkan') }}');
    initSortable('grid-video', '{{ route('admin.video.urutkan') }}');

    // Upload & Delete Media Logic
    function handleUpload(inputId, endpoint, type) {
        document.getElementById(inputId).addEventListener('change', async (e) => {
            const files = e.target.files;
            if(!files.length) return;
            
            tampilkanToast('Mengunggah...', 'info');
            
            for(let file of files) {
                const formData = new FormData();
                formData.append(type, file);
                
                try {
                    const res = await fetch(endpoint, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: formData
                    });
                    const data = await res.json();
                    if(data.sukses) {
                        tampilkanToast('Berhasil diunggah!');
                        setTimeout(() => location.reload(), 1000); // Reload simpel
                    } else {
                        tampilkanToast(data.pesan || 'Gagal mengunggah', 'gagal');
                    }
                } catch (err) {
                    tampilkanToast('Terjadi kesalahan', 'gagal');
                }
            }
        });
    }

    handleUpload('upload-foto', '{{ route('admin.foto.unggah') }}', 'foto');
    handleUpload('upload-video', '{{ route('admin.video.unggah') }}', 'video');

    function hapusMedia(type, id, btn) {
        if(!confirm('Yakin hapus ' + type + ' ini?')) return;
        fetch(`/admin/${type}/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(res => res.json()).then(data => {
            if(data.sukses) {
                btn.closest('[data-id]').remove();
                tampilkanToast('Berhasil dihapus');
            }
        });
    }
</script>
@endsection
