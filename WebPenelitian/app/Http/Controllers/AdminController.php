<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JawabanResponden; // Ganti dengan model Anda
use App\Exports\JawabanExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function showLoginForm() {
        return view('admin.login');
    }

    public function login(Request $request) {
        // Ambil data dari .env
        $validUser = env('ADMIN_USER');
        $validPass = env('ADMIN_PASS');

        if ($request->username === $validUser && $request->password === $validPass) {
            // Jika cocok, buat tanda di session
            $request->session()->put('admin_logged_in', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function dashboard() {
        $jawabans = JawabanResponden::orderBy('Tanggal', 'desc')->get();
        return view('admin.dashboard', compact('jawabans'));
    }

    public function logout(Request $request) {
        $request->session()->forget('admin_logged_in');
        return redirect()->route('admin.login.form');
    }

    public function downloadCsv()
{
    // 1. Ambil data dari database
    $data = \App\Models\JawabanResponden::orderBy('Tanggal', 'desc')->get();

    // 2. Tentukan nama file
    $filename = "data-responden-" . date('Y-m-d') . ".csv";

    // 3. Header agar browser mendownload file sebagai CSV
    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    // 4. Proses pembuatan isi file
    $callback = function() use($data) {
        $file = fopen('php://output', 'w');
        
        // Judul Kolom (Baris pertama di Excel)
        fputcsv($file, [
            'No Jawab', 'Tanggal', 'IS', 'Nama', 'Gender', 'Usia', 
            'Pendidikan Terakhir', 'Daerah Domisili', 'Kecamatan', 
            'Pekerjaan', 'No HP', 'Plotting', 'Saldo', 'Menu Makanan', 
            'Menu Minuman', 'Subsidi/Insentif', 'Pajak', 'Total', 
            'Top Up', 'TIME_CASE_PRES', 'TIME_ALL'
        ]);

        // Isi Data
        foreach ($data as $row) {
            fputcsv($file, [
                $row->NoJawab,
                $row->Tanggal,
                $row->IS,
                $row->Nama,
                $row->Gender,
                $row->Usia,
                $row->PendidikanTerakhir,
                $row->DaerahDomisili,
                $row->Kecamatan,
                $row->Pekerjaan,
                $row->NoHP,
                $row->Plotting,
                $row->Saldo,
                $row->MenuMakanan,
                $row->MenuMinuman,
                $row->{'Subsidi/Insentif'},
                $row->Pajak,
                $row->Total,
                $row->TopUp,
                $row->TIME_CASE_PRES,
                $row->TIME_ALL,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}