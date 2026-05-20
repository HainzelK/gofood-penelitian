<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Halaman 1 & 2 tetap sama...
Route::get('/consent', function () { return view('persetujuan'); })->name('consent');
Route::get('/informasi-diri', function () { return view('informasi_diri'); })->name('informasi.diri');

// PROSES SIMPAN DOMISILI
Route::post('/simpan-informasi', function (Request $request) {
    // Simpan pilihan domisili ke dalam session
    session(['domisili' => $request->domisili]);
    
    // Pindah ke halaman instruksi
    return redirect()->route('instruksi');
})->name('simpan.informasi');

// Halaman 3: Instruksi Pengerjaan
Route::get('/instruksi', function () {
    return view('instruksi');
})->name('instruksi');

// PROSES FILTERING HALAMAN (Logika Mulai)
Route::get('/mulai-simulasi', function () {
    $domisili = session('domisili');

    if ($domisili == 'Toraja') {
        return redirect('/simulasi/toraja');
    } elseif ($domisili == 'Makassar') {
        return redirect('/simulasi/makassar');
    }
    
    return redirect('/informasi-diri'); // Balik jika session hilang
})->name('mulai.simulasi');

// Halaman Khusus Daerah (Contoh Halaman Kosong)
Route::get('/simulasi/toraja', function () { return "<h1>Selamat Datang di Simulasi Toraja</h1>"; });
Route::get('/simulasi/makassar', function () { return "<h1>Selamat Datang di Simulasi Makassar</h1>"; });