<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Harapan;
use App\Models\Pengaturan;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Cek autentikasi admin via session di setiap request.
     */
    public function __construct()
    {
        // Middleware manual: redirect ke login jika belum login
    }

    /**
     * Pastikan admin sudah login, atau redirect ke halaman login.
     */
    private function cekLogin(): ?RedirectResponse
    {
        if (!Session::get('admin_login')) {
            return redirect()->route('admin.login')->withErrors(['auth' => 'Silakan login terlebih dahulu.']);
        }
        return null;
    }

    /**
     * Tampilkan dashboard admin dengan semua data.
     */
    public function dashboard(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->cekLogin()) {
            return $redirect;
        }

        // Ambil semua pengaturan sebagai array key-value
        $pengaturanRaw = Pengaturan::all();
        $pengaturan = [];
        foreach ($pengaturanRaw as $p) {
            $pengaturan[$p->kunci] = $p->nilai;
        }

        // Ambil semua data untuk ditampilkan di dashboard
        $harapans = Harapan::withoutGlobalScopes()->orderBy('urutan')->get();
        $fotos    = Foto::withoutGlobalScopes()->orderBy('urutan')->get();
        $videos   = Video::withoutGlobalScopes()->orderBy('urutan')->get();

        return view('admin.dashboard', compact('pengaturan', 'harapans', 'fotos', 'videos'));
    }
}
