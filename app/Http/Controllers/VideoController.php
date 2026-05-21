<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VideoController extends Controller
{
    /**
     * Unggah video baru dan simpan ke public.
     */
    public function unggah(Request $request): JsonResponse
    {
        if (!Session::get('admin_login')) {
            return response()->json(['sukses' => false, 'pesan' => 'Unauthorized'], 401);
        }

        $request->validate([
            'video' => 'required|file|max:102400',
        ], [
            'video.required' => 'File video wajib diunggah.',
            'video.max'      => 'Ukuran video maksimal 100MB.',
        ]);

        $file      = $request->file('video');
        $namaFile  = $file->getClientOriginalName();
        $namaUnik  = 'video_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('galeri/video'), $namaUnik);

        // Tentukan urutan otomatis
        $urutan = Video::withoutGlobalScopes()->max('urutan') + 1;

        $video = Video::create([
            'nama_file' => $namaFile,
            'path'      => 'galeri/video/' . $namaUnik,
            'thumbnail' => null, // thumbnail otomatis tidak tersedia di PHP murni
            'urutan'    => $urutan,
        ]);

        return response()->json([
            'sukses' => true,
            'data'   => $video,
        ]);
    }

    /**
     * Hapus video dari public dan database.
     */
    public function hapus($id): JsonResponse
    {
        if (!Session::get('admin_login')) {
            return response()->json(['sukses' => false, 'pesan' => 'Unauthorized'], 401);
        }

        $video = Video::withoutGlobalScopes()->findOrFail($id);

        // Hapus file video fisik
        if ($video->path && file_exists(public_path($video->path))) {
            unlink(public_path($video->path));
        }

        // Hapus thumbnail jika ada
        if ($video->thumbnail && file_exists(public_path($video->thumbnail))) {
            unlink(public_path($video->thumbnail));
        }

        $video->delete();

        return response()->json(['sukses' => true]);
    }

    /**
     * Perbarui urutan video berdasarkan array ID.
     */
    public function urutkan(Request $request): JsonResponse
    {
        if (!Session::get('admin_login')) {
            return response()->json(['sukses' => false, 'pesan' => 'Unauthorized'], 401);
        }

        $request->validate([
            'urutan'   => 'required|array',
            'urutan.*' => 'integer|exists:videos,id',
        ]);

        foreach ($request->urutan as $index => $id) {
            Video::withoutGlobalScopes()->where('id', $id)->update(['urutan' => $index]);
        }

        return response()->json(['sukses' => true]);
    }
}