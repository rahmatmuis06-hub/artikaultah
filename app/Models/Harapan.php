<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Harapan extends Model
{
    /**
     * Kolom yang boleh diisi massal.
     */
    protected $fillable = ['isi', 'urutan', 'aktif'];

    /**
     * Cast tipe data kolom.
     */
    protected $casts = [
        'aktif' => 'boolean',
    ];

    /**
     * Urutkan default berdasarkan kolom urutan secara ascending.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('urutan', function (Builder $builder) {
            $builder->orderBy('urutan', 'asc');
        });
    }

    /**
     * Scope untuk filter harapan yang aktif saja.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('aktif', true);
    }
}
