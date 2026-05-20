<?php

use Illuminate\Support\Facades\Route;

Route::get('/consent', function () {
    return view('consent');
});

Route::get('/informasi-diri', function () {
    return view('informasi_diri');
})->name('informasi.diri');

Route::get('/terima-kasih', function () {
    return "<h1>Terima kasih atas waktu Anda.</h1>"; // Halaman kosong sementara
})->name('terima.kasih');