<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestoranController;
use App\Http\Controllers\PlottingController; 

// 1. Restaurant and Menu API Routes (TETAP)
Route::get('/restaurants', [RestoranController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}/menus', [RestoranController::class, 'showMenus'])->name('restaurants.menus');

// 2. Halaman Awal & Informasi Diri (TETAP)
Route::get('/consent', function () { return view('consent'); })->name('consent');
Route::get('/informasi-diri', function () { return view('informasi_diri'); })->name('informasi.diri');

// 3. PROSES SIMPAN + LOGIKA PLOTTING (UPDATE: Langsung Redirect ke Info Umum)
// Di dalam PlottingController@store nanti harus redirect ke 'info.makassar' atau 'info.toraja'
Route::post('/simpan-informasi', [PlottingController::class, 'store'])->name('simpan.informasi');

// 4. Halaman Khusus Daerah / Info Umum (TETAP)
Route::get('/informasi_umum_toraja', function () { return view('informasi_umum_toraja'); })->name('info.toraja');
Route::get('/informasi_umum_makassar', function () { return view('informasi_umum_makassar'); })->name('info.makassar');

// 5. REDIRECT KE INSTRUKSI KHUSUS PLOTTING (UPDATE: Tombol "Lanjut" dari Info Umum lari ke sini)
// showPlotting akan mengembalikan view instruksi sesuai plotting user (itpt, irpt, dll)
Route::get('/detail-plotting', [PlottingController::class, 'showPlotting'])->name('detail.plotting');

// Halaman Step 3 (Konstan)
Route::get('/instruksi_3', function () {
    return view('instruksi_3');
})->name('instruksi.3');

// 6. Halaman Restoran & Menu (TETAP)
Route::get('/pilihan_menu', function () { return view('pilihan_menu'); })->name('pilihan.menu');    
Route::get('/pilihan-restoran/{jenis}', [RestoranController::class, 'showByJenis'])->name('restoran.jenis');
Route::get('/restoran/{id}/menu', [RestoranController::class, 'showMenuPage'])->name('restoran.menu');

Route::get('/pembayaran', function () {
    // Anda bisa menambahkan logic untuk mengambil data pesanan di sini jika perlu
    return view('pembayaran');
})->name('pembayaran');

Route::get('/topup', function () {
    return view('top_up');
})->name('topup');
