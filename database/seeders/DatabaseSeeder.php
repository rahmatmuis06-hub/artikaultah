<?php

namespace Database\Seeders;

use App\Models\Harapan;
use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Isi database dengan data awal.
     */
    public function run(): void
    {
        // ====== Pengaturan Default ======
        $pengaturanDefault = [
            'nama_penerima'  => 'Artika D. Pasambuna',
            'nama_pengirim'  => 'Fathaway',
            'tanggal_lahir'  => '01/06',
            'pesan_utama'    => 'Semoga sehat selalu dan selalu menjadi kebanggaan orang tua.',
            'tema_warna'     => 'pink',
            'putar_otomatis' => 'true',
        ];

        foreach ($pengaturanDefault as $kunci => $nilai) {
            Pengaturan::simpan($kunci, $nilai);
        }

        // ====== Harapan Default ======
        $harapanDefault = [
            ['isi' => 'Selalu diberikan kesehatan dan umur panjang', 'urutan' => 0],
            ['isi' => 'Menjadi kebanggaan orang tua di setiap langkahmu', 'urutan' => 1],
            ['isi' => 'Semua impian dan cita-citamu terwujud', 'urutan' => 2],
            ['isi' => 'Selalu dilindungi dan diberkahi setiap harinya', 'urutan' => 3],
        ];

        foreach ($harapanDefault as $data) {
            // Hanya buat jika belum ada
            if (!Harapan::withoutGlobalScopes()->where('isi', $data['isi'])->exists()) {
                Harapan::create([
                    'isi'    => $data['isi'],
                    'urutan' => $data['urutan'],
                    'aktif'  => true,
                ]);
            }
        }
    }
}
