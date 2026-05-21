<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Unggah video baru dan simpan ke storage.
     */
    public function unggah(Request $request): JsonResponse
    {
        if (!Session::get('admin_login')) {
            return response()->json(['sukses' => false, 'pesan' => 'Unauthorized'], 401);
        }

        $request->validate([
            'video' => 'required|file|mimes:mp4,webm|max:51200',
        ], [
            'video.required' => 'File video wajib diunggah.',
            'video.mimes'    => 'Format video harus mp4 atau webm.',
            'video.max'      => 'Ukuran video maksimal 50MB.',
        ]);

        $file      = $request->file('video');
        $namaFile  = $file->getClientOriginalName();
        $namaUnik  = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path      = $file->storeAs('public/videos', $namaUnik);

        // Tentukan urutan otomatis
        $urutan = Video::withoutGlobalScopes()->max('urutan') + 1;

        $video = Video::create([
            'nama_file' => $namaFile,
            'path'      => 'public/videos/' . $namaUnik,
            'thumbnail' => null, // thumbnail otomatis tidak tersedia di PHP murni
            'urutan'    => $urutan,
        ]);

        return response()->json([
            'sukses' => true,
            'data'   => $video,
        ]);
    }

    /**
     * Hapus video dari storage dan database.
     */
    public function hapus($id): JsonResponse
    {
        if (!Session::get('admin_login')) {
            return response()->json(['sukses' => false, 'pesan' => 'Unauthorized'], 401);
        }

        $video = Video::withoutGlobalScopes()->findOrFail($id);

        // Hapus file video dari storage
        if (Storage::exists($video->path)) {
            Storage::delete($video->path);
        }

        // Hapus thumbnail jika ada
        if ($video->thumbnail && Storage::exists($video->thumbnail)) {
            Storage::delete($video->thumbnail);
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
