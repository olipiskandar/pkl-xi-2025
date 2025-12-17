<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::controller(GoogleController::class)->group(function () {
    // ================================================
    // ROUTE 1: REDIRECT KE GOOGLE
    // ================================================
    // URL: /auth/google
    // Dipanggil saat user klik tombol "Login dengan Google"
    // ================================================
    Route::get('/auth/google', 'redirect')
        ->name('auth.google');

    // ================================================
    // ROUTE 2: CALLBACK DARI GOOGLE
    // ================================================
    // URL: /auth/google/callback
    // Dipanggil oleh Google setelah user klik "Allow"
    // URL ini HARUS sama dengan yang didaftarkan di Google Console!
    // ================================================
    Route::get('/auth/google/callback', 'callback')
        ->name('auth.google.callback');
});

Route::middleware('auth')->group(function () {
    Route::get('tentang', function () {
        return view('tentang');
    });
    Route::get('/kategori/{nama?}', function ($nama = 'Semua') {
        return "Menampilkan kategori: $nama";
    })->name('categori.detail');

    Route::get('/product/{id}', function ($id = 'belum-ada') {
        return "Detail produk #$id";
    })->name('produk.detail');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
