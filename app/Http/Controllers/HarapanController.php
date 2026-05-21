<?php

namespace App\Http\Controllers;

use App\Models\Harapan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HarapanController extends Controller
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
     * Simpan harapan baru ke database.
     */
    public function simpan(Request $request): RedirectResponse
    {
        if ($redirect = $this->cekLogin()) {
            return $redirect;
        }

        $request->validate([
            'isi'    => 'required|string|max:300',
            'urutan' => 'nullable|integer|min:0',
            'aktif'  => 'nullable|boolean',
        ]);

        // Tentukan urutan otomatis jika tidak diisi
        $urutan = $request->urutan ?? (Harapan::withoutGlobalScopes()->max('urutan') + 1);

        Harapan::create([
            'isi'    => $request->isi,
            'urutan' => $urutan,
            'aktif'  => $request->has('aktif') ? (bool)$request->aktif : true,
        ]);

        return redirect()->back()->with('sukses', 'Harapan berhasil ditambahkan.');
    }

    /**
     * Perbarui harapan yang sudah ada.
     */
    public function ubah(Request $request, $id): RedirectResponse
    {
        if ($redirect = $this->cekLogin()) {
            return $redirect;
        }

        $request->validate([
            'isi'    => 'required|string|max:300',
            'urutan' => 'nullable|integer|min:0',
            'aktif'  => 'nullable',
        ]);

        $harapan = Harapan::withoutGlobalScopes()->findOrFail($id);
        $harapan->update([
            'isi'    => $request->isi,
            'urutan' => $request->urutan ?? $harapan->urutan,
            'aktif'  => $request->has('aktif') ? (bool)$request->aktif : false,
        ]);

        return redirect()->back()->with('sukses', 'Harapan berhasil diperbarui.');
    }

    /**
     * Hapus harapan dari database.
     */
    public function hapus($id): RedirectResponse
    {
        if ($redirect = $this->cekLogin()) {
            return $redirect;
        }

        $harapan = Harapan::withoutGlobalScopes()->findOrFail($id);
        $harapan->delete();

        return redirect()->back()->with('sukses', 'Harapan berhasil dihapus.');
    }

    /**
     * Perbarui urutan harapan berdasarkan array ID yang dikirim.
     */
    public function urutkan(Request $request): JsonResponse
    {
        if (!Session::get('admin_login')) {
            return response()->json(['sukses' => false, 'pesan' => 'Unauthorized'], 401);
        }

        $request->validate([
            'urutan'   => 'required|array',
            'urutan.*' => 'integer|exists:harapans,id',
        ]);

        foreach ($request->urutan as $index => $id) {
            Harapan::withoutGlobalScopes()->where('id', $id)->update(['urutan' => $index]);
        }

        return response()->json(['sukses' => true]);
    }
}
