<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthAdminController extends Controller
{
    /**
     * Tampilkan halaman login admin.
     */
    public function tampilkanLogin(): View|RedirectResponse
    {
        // Jika sudah login, langsung ke dashboard
        if (Session::get('admin_login')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Proses login admin dengan validasi password.
     */
    public function prosesLogin(Request $request): RedirectResponse
    {
        // Validasi: password wajib diisi
        $request->validate([
            'password' => 'required',
        ], [
            'password.required' => 'Password wajib diisi.',
        ]);

        $passwordBenar = env('ADMIN_PASSWORD', 'admin123');

        if ($request->password === $passwordBenar) {
            // Simpan session login admin
            Session::put('admin_login', true);
            return redirect()->route('admin.dashboard')->with('sukses', 'Selamat datang, Admin!');
        }

        return redirect()->back()->withErrors(['password' => 'Password salah. Coba lagi.']);
    }

    /**
     * Logout admin dan hapus session.
     */
    public function logout(): RedirectResponse
    {
        Session::forget('admin_login');
        return redirect()->route('publik.index');
    }
}
