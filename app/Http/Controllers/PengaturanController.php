<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    /**
     * Pastikan admin sudah login.
     */
    private function cekLogin(): ?RedirectResponse
    {
        if (!Session::get('admin_login')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    /**
     * Simpan atau perbarui pengaturan aplikasi.
     */
    public function update(Request $request): RedirectResponse
    {
        if ($redirect = $this->cekLogin()) {
            return $redirect;
        }

        // Validasi semua field pengaturan
        $request->validate([
            'nama_penerima'  => 'required|string|max:100',
            'nama_pengirim'  => 'required|string|max:100',
            'tanggal_lahir'  => ['required', 'string', 'regex:/^\d{2}\/\d{2}$/'],
            'pesan_utama'    => 'required|string|max:500',
            'tema_warna'     => 'required|in:pink,purple,merah_gold,biru_mint',
            'putar_otomatis' => 'nullable',
            'musik_latar'    => 'nullable|file|max:15360',
        ], [
            'tanggal_lahir.regex' => 'Format tanggal lahir harus dd/mm (contoh: 01/06).',
            'tema_warna.in'       => 'Tema warna tidak valid.',
            'musik_latar.mimes'   => 'Format musik harus mp3, wav, atau ogg.',
            'musik_latar.max'     => 'Ukuran musik maksimal 15MB.',
        ]);

        // Simpan file musik jika diunggah
        if ($request->hasFile('musik_latar')) {
            $lama = Pengaturan::ambil('musik_latar');
            if ($lama && file_exists(public_path($lama))) {
                unlink(public_path($lama));
            }
            $file = $request->file('musik_latar');
            $namaUnik = 'musik_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('musik'), $namaUnik);
            Pengaturan::simpan('musik_latar', 'musik/' . $namaUnik);
        }

        // Simpan semua pengaturan ke tabel
        Pengaturan::simpan('nama_penerima', $request->nama_penerima);
        Pengaturan::simpan('nama_pengirim', $request->nama_pengirim);
        Pengaturan::simpan('tanggal_lahir', $request->tanggal_lahir);
        Pengaturan::simpan('pesan_utama', $request->pesan_utama);
        Pengaturan::simpan('tema_warna', $request->tema_warna);
        Pengaturan::simpan('putar_otomatis', $request->has('putar_otomatis') ? 'true' : 'false');

        return redirect()->back()->with('sukses', 'Pengaturan berhasil disimpan.');
    }
}
