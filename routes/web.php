<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Halaman utama bawaan Laravel
// Mengarahkan halaman utama (/) langsung ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// Rute Registrasi Akun
Route::get('/register', [AuthController::class, 'tampilRegister']);
Route::post('/register', [AuthController::class, 'prosesRegister']);

// Rute Login Akun
Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);

// Rute yang memerlukan autentikasi (wajib login terlebih dahulu)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rute khusus untuk role admin (dilindungi middleware 'role:admin')
    Route::get('/panel-admin', function () {
        return "<h1>Panel Ruang Server Admin</h1><p>Halo Admin! Kamu memiliki hak akses penuh di halaman ini.</p><a href='/dashboard'>Kembali ke Dashboard</a>";
    })->middleware('role:admin');

    // Rute khusus untuk role mahasiswa (dilindungi middleware 'role:mahasiswa')
    Route::get('/krs-mahasiswa', function () {
        return "<h1>Halaman Pengisian KRS Mahasiswa</h1><p>Silakan pilih mata kuliah sesuai peminatan kamu semester ini.</p><a href='/dashboard'>Kembali ke Dashboard</a>";
    })->middleware('role:mahasiswa');
});