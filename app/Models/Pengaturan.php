<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    /**
     * Kolom yang boleh diisi massal.
     */
    protected $fillable = ['kunci', 'nilai'];

    /**
     * Ambil nilai pengaturan berdasarkan kunci.
     * Mengembalikan nilai default jika kunci tidak ditemukan.
     *
     * @param string $kunci
     * @param mixed $default
     * @return mixed
     */
    public static function ambil(string $kunci, mixed $default = null): mixed
    {
        $pengaturan = static::where('kunci', $kunci)->first();
        return $pengaturan ? $pengaturan->nilai : $default;
    }

    /**
     * Simpan atau perbarui nilai pengaturan berdasarkan kunci.
     *
     * @param string $kunci
     * @param mixed $nilai
     * @return static
     */
    public static function simpan(string $kunci, mixed $nilai): static
    {
        return static::updateOrCreate(
            ['kunci' => $kunci],
            ['nilai' => $nilai]
        );
    }
}
