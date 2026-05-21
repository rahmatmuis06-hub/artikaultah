# Laravel Landing Page Template

Template Laravel dengan Tailwind CSS, Landing Page, dan fitur Login & Register.

## 📁 Struktur File

```
resources/views/
├── layouts/
│   ├── app.blade.php        ← Layout utama (navbar + footer)
│   └── auth.blade.php       ← Layout halaman auth
├── pages/
│   └── home.blade.php       ← Landing page
└── auth/
    ├── login.blade.php      ← Halaman login
    └── register.blade.php   ← Halaman register

routes/
└── web.php                  ← Routing aplikasi
```

## 🚀 Cara Pasang ke Project Laravel

### 1. Salin file views
Salin semua file dari `resources/views/` ke folder yang sama di project Laravel kamu.

### 2. Salin routes
Salin isi `routes/web.php` ke file routes kamu.

### 3. Pasang Auth Controllers
Jika belum ada, install Laravel Breeze:
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
npm install && npm run dev
```

Atau gunakan auth controllers bawaan Laravel Breeze yang sudah ada.

### 4. Jalankan aplikasi
```bash
php artisan serve
```

Buka browser: `http://127.0.0.1:8000`

## 🎨 Kustomisasi

### Ganti nama aplikasi
Edit file `.env`:
```
APP_NAME="Nama Aplikasi Kamu"
```

### Ganti warna utama
Di `layouts/app.blade.php`, cari `sky` dan ganti dengan warna Tailwind lain:
- `blue` → biru
- `emerald` → hijau  
- `violet` → ungu
- `rose` → merah muda

### Ganti font
Di bagian `<head>`, ganti link Google Fonts dan nama font di `tailwind.config`.

## 📄 Halaman yang Tersedia

| URL | Halaman |
|-----|---------|
| `/` | Landing Page |
| `/login` | Halaman Login |
| `/register` | Halaman Register |
| `/dashboard` | Dashboard (setelah login) |
