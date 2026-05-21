<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    /**
     * Kolom yang boleh diisi massal.
     */
    protected $fillable = ['nama_file', 'path', 'thumbnail', 'urutan'];

    /**
     * Tambahkan accessor ke array model.
     */
    protected $appends = ['url', 'thumbnail_url'];

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
     * Accessor untuk mendapatkan URL publik video.
     *
     * @return Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::url($this->path),
        );
    }

    /**
     * Accessor untuk mendapatkan URL publik thumbnail video.
     *
     * @return Attribute
     */
    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->thumbnail ? Storage::url($this->thumbnail) : null,
        );
    }
}
