<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FotoController extends Controller
{
    /**
     * Unggah foto baru dan simpan ke storage.
     */
    public function unggah(Request $request): JsonResponse
    {
        if (!Session::get('admin_login')) {
            return response()->json(['sukses' => false, 'pesan' => 'Unauthorized'], 401);
        }

        $request->validate([
            'foto'   => 'required|file|max:20480',
        ], [
            'foto.required' => 'File foto wajib diunggah.',
            'foto.max'      => 'Ukuran foto maksimal 20MB.',
        ]);

        $file      = $request->file('foto');
        $namaFile  = $file->getClientOriginalName();
        $namaUnik  = 'foto_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('galeri/foto'), $namaUnik);

        // Tentukan urutan otomatis
        $urutan = Foto::withoutGlobalScopes()->max('urutan') + 1;

        $foto = Foto::create([
            'nama_file' => $namaFile,
            'path'      => 'galeri/foto/' . $namaUnik,
            'urutan'    => $urutan,
        ]);

        return response()->json([
            'sukses' => true,
            'data'   => $foto,
        ]);
    }

    /**
     * Hapus foto dari storage dan database.
     */
    public function hapus($id): JsonResponse
    {
        if (!Session::get('admin_login')) {
            return response()->json(['sukses' => false, 'pesan' => 'Unauthorized'], 401);
        }

        $foto = Foto::withoutGlobalScopes()->findOrFail($id);

        // Hapus file fisik
        if ($foto->path && file_exists(public_path($foto->path))) {
            unlink(public_path($foto->path));
        }

        $foto->delete();

        return response()->json(['sukses' => true]);
    }

    /**
     * Perbarui urutan foto berdasarkan array ID.
     */
    public function urutkan(Request $request): JsonResponse
    {
        if (!Session::get('admin_login')) {
            return response()->json(['sukses' => false, 'pesan' => 'Unauthorized'], 401);
        }

        $request->validate([
            'urutan'   => 'required|array',
            'urutan.*' => 'integer|exists:fotos,id',
        ]);

        foreach ($request->urutan as $index => $id) {
            Foto::withoutGlobalScopes()->where('id', $id)->update(['urutan' => $index]);
        }

        return response()->json(['sukses' => true]);
    }
}
