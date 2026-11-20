# Sistem Portal Akademik Multi-Role

Aplikasi portal akademik Laravel dengan autentikasi dan **hak akses berbasis role**. Setiap pengguna hanya dapat membuka halaman sesuai role-nya.

## Fitur

- Registrasi akun dengan pilihan role **admin** atau **mahasiswa**.
- Login, logout, dan proteksi halaman dengan middleware `auth`.
- Middleware `role` untuk membatasi akses per role.
- Dashboard yang menampilkan menu berbeda sesuai role.
- Halaman khusus admin (`/panel-admin`) dan halaman KRS mahasiswa (`/krs-mahasiswa`).
- Halaman 403 bila role tidak sesuai.

## Teknologi

- PHP 8.3+
- Laravel
- Blade Template
- SQLite (default pada `.env.example`)

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Buka http://localhost:8000, lalu daftar melalui `/register` dan pilih role yang diinginkan.

## Akun Demo

Belum ada akun bawaan. Buat akun melalui halaman registrasi:

1. Buka `/register`.
2. Isi nama, email, password, dan pilih role **admin** atau **mahasiswa**.
3. Login melalui `/login`.

## Route

| Method | URI | Middleware | Keterangan |
|---|---|---|---|
| GET/POST | `/register` | — | Form dan proses registrasi |
| GET/POST | `/login` | — | Form dan proses login |
| GET | `/dashboard` | `auth` | Dashboard sesuai role |
| POST | `/logout` | `auth` | Keluar dari akun |
| GET | `/panel-admin` | `auth`, `role:admin` | Halaman khusus admin |
| GET | `/krs-mahasiswa` | `auth`, `role:mahasiswa` | Halaman KRS mahasiswa |

## Struktur Penting

- `app/Http/Controllers/AuthController.php` — registrasi, login, dashboard, logout.
- `app/Http/Middleware/CekRole.php` — pengecekan role pengguna.
- `resources/views/auth_*.blade.php` — tampilan autentikasi dan dashboard.
