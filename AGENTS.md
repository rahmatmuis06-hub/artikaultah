 # Project: Artikaultah

## Stack
- Laravel 11
- Tailwind CSS
- MySQL
- PHP 8.2

## Struktur Project
- `resources/views/` — File blade template
- `app/Http/Controllers/` — Logic controller
- `app/Models/` — Eloquent models
- `routes/web.php` — Routing web
- `routes/api.php` — Routing API

## Konvensi Kode
- Gunakan bahasa Indonesia untuk nama variabel dan komentar
- Controller menggunakan format `NamaController.php`
- Model menggunakan singular: `User`, `Post`, `Artikel`
- Nama tabel plural: `users`, `posts`, `artikels`

## Perintah Penting
- Jalankan server: `php artisan serve`
- Migrasi database: `php artisan migrate`
- Buat controller: `php artisan make:controller NamaController`
- Buat model: `php artisan make:model NamaModel -m`

## Aturan Tambahan
- Selalu validasi input di Controller
- Gunakan Eloquent, hindari query SQL mentah
- Setiap fitur baru harus ada migrasinya

