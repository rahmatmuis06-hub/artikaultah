<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\HarapanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PublikController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Artikaultah Birthday Surprise System
|--------------------------------------------------------------------------
*/

// ====== Halaman Publik ======
Route::get('/', [PublikController::class, 'index'])->name('publik.index');

// ====== Auth User ======
Route::get('/register', [AuthController::class, 'tampilkanRegister'])->name('register');
Route::post('/register', [AuthController::class, 'prosesRegister'])->name('register.proses');
Route::get('/login', [AuthController::class, 'tampilkanLogin'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====== Home Page ======
Route::get('/home', function () {
    return view('pages.home');
})->name('home');

// ====== Auth Admin ======
Route::get('/admin/login', [AuthAdminController::class, 'tampilkanLogin'])->name('admin.login');
Route::post('/admin/login', [AuthAdminController::class, 'prosesLogin'])->name('admin.prosesLogin');
Route::post('/admin/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');

// ====== Admin Panel (semua butuh session login) ======
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Pengaturan
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    // Harapan
    Route::post('/harapan', [HarapanController::class, 'simpan'])->name('harapan.simpan');
    Route::put('/harapan/{id}', [HarapanController::class, 'ubah'])->name('harapan.ubah');
    Route::delete('/harapan/{id}', [HarapanController::class, 'hapus'])->name('harapan.hapus');
    Route::post('/harapan/urutkan', [HarapanController::class, 'urutkan'])->name('harapan.urutkan');

    // Foto
    Route::post('/foto/unggah', [FotoController::class, 'unggah'])->name('foto.unggah');
    Route::delete('/foto/{id}', [FotoController::class, 'hapus'])->name('foto.hapus');
    Route::post('/foto/urutkan', [FotoController::class, 'urutkan'])->name('foto.urutkan');

    // Video
    Route::post('/video/unggah', [VideoController::class, 'unggah'])->name('video.unggah');
    Route::delete('/video/{id}', [VideoController::class, 'hapus'])->name('video.hapus');
    Route::post('/video/urutkan', [VideoController::class, 'urutkan'])->name('video.urutkan');
});
