<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
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

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get(
        'admin',
        function () {
            return "Halaman Admin";
        }
    );
});
