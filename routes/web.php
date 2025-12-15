<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('tentang', function () {
    return view('tentang');
});


Route::get('/kategori/{nama?}', function ($nama = 'Semua') {
    // ↑ {nama?} = Tanda ? berarti parameter OPSIONAL
    // ↑ $nama = 'Semua' = Nilai default jika parameter tidak diberikan

    return "Menampilkan kategori: $nama";
})->name('categori.detail');

Route::get('/product/{id}', function ($id = 'belum-ada') {
    return "Detail produk #$id";
})->name('produk.detail');
