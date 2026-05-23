<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestoranController;
use App\Http\Controllers\PlottingController; // 1. Import Controller Baru

// 2. Daftarkan Middleware Alias (agar bisa dipakai di route group nanti)
// Pastikan Anda sudah membuat file app/Http/Middleware/CheckPlotting.php
Route::middleware('web')->group(function () {
    
    // ==========================================
    // ROUTE LAMA (TIDAK DIUBAH SAMA SEKALI)
    // ==========================================
    
    // Restaurant and Menu API Routes
    Route::get('/restaurants', [RestoranController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/{id}/menus', [RestoranController::class, 'showMenus'])->name('restaurants.menus');

    // Halaman 1 & 2 tetap sama...
    Route::get('/consent', function () { return view('consent'); })->name('consent');
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
            return redirect('informasi_umum_toraja');
        } elseif ($domisili == 'Makassar') {
            return redirect('informasi_umum_makassar');
        }
        
        return redirect('/informasi-diri'); // Balik jika session hilang
    })->name('mulai.simulasi');

    // Halaman Khusus Daerah (Contoh Halaman Kosong)
    Route::get('/informasi_umum_toraja', function () { return view('informasi_umum_toraja'); });
    Route::get('/informasi_umum_makassar', function () { return view('informasi_umum_makassar'); });

    Route::get('/pilihan_menu', function () { return view('pilihan_menu'); })->name('pilihan.menu');

    // Route untuk halaman pilihan restoran berdasarkan jenis (HF atau TGGL)
    Route::get('/pilihan-restoran/{jenis}', [RestoranController::class, 'showByJenis'])->name('restoran.jenis');
    Route::get('/restoran/{id}/menu', [RestoranController::class, 'showMenuPage'])->name('restoran.menu');


    // ==========================================
    // ROUTE BARU (SISTEM PLOTTING)
    // ==========================================
    
    // Group route yang wajib login dan sudah di-plotting
    Route::middleware(['auth', 'check.plotting'])->group(function () {
        // Halaman utama setelah plotting (mengarah ke simulasi/restoran)
        Route::get('/dashboard', [PlottingController::class, 'dashboard'])->name('dashboard');
        
        // Stats plotting (opsional, untuk admin/monitoring)
        Route::get('/plotting-stats', [PlottingController::class, 'stats'])->name('plotting.stats');
    });

    // Route untuk proses assignment plotting (hanya untuk user yang belum di-plot)
    Route::middleware(['auth'])->group(function () {
        // Update route post '/simpan-informasi' atau buat route baru khusus plotting
        // Disarankan menggunakan route baru agar logika lama tidak bentrok
        Route::post('/assign-plotting', [PlottingController::class, 'assign'])->name('plotting.assign');
    });
});