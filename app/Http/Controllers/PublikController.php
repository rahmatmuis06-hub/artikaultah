<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Harapan;
use App\Models\Pengaturan;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublikController extends Controller
{
    /**
     * Tampilkan halaman utama publik birthday surprise.
     */
    public function index()
    {
        // Ambil semua pengaturan sebagai array key-value
        $pengaturanRaw = Pengaturan::all();
        $pengaturan = [];
        foreach ($pengaturanRaw as $p) {
            $pengaturan[$p->kunci] = $p->nilai;
        }

        // Ambil semua harapan yang aktif, urut by urutan
        $harapans = Harapan::aktif()->get();

        // Ambil semua foto urut by urutan
        $fotos = Foto::all();

        // Ambil semua video urut by urutan
        $videos = Video::all();

        // Hitung countdown ke tanggal ulang tahun (dari pengaturan)
        $tanggalLahir = $pengaturan['tanggal_lahir'] ?? '01/06';
        [$hari, $bulan] = explode('/', $tanggalLahir);
        $tahunSekarang = Carbon::now()->year;
        $ultah = Carbon::createFromDate($tahunSekarang, (int)$bulan, (int)$hari);

        // Jika ultah sudah lewat tahun ini, hitung ke tahun depan
        if ($ultah->isPast() && !$ultah->isToday()) {
            $ultah->addYear();
        }

        $countdown = [
            'tanggal_ultah' => $ultah->toISOString(),
            'sudah_ultah'   => $ultah->isToday(),
        ];

        return view('publik.index', compact(
            'pengaturan',
            'harapans',
            'fotos',
            'videos',
            'countdown'
        ));
    }
}
