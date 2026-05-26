<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PlottingController extends Controller
{
public function store(Request $request)
{
    $domisili = $request->domisili;
    $listPlotting = ['ITPT', 'IRPT', 'IRPR', 'ITPR'];
    $limit = 30;

    // 1. Hitung jumlah orang di setiap plotting
    $counts = [];
    foreach ($listPlotting as $plot) {
        $count = \App\Models\User::where('domisili', $domisili)
                                ->where('plotting', $plot)
                                ->count();
        if ($count < $limit) {
            $counts[$plot] = $count;
        }
    }

    if (empty($counts)) {
        return back()->with('error', 'Kuota penuh.');
    }

    // --- LOGIKA RANDOMIZE BARU ---
    // Cari angka terkecil (misal: 0)
    $minCount = min($counts); 

    // Ambil semua plotting yang isinya sama-sama paling sedikit (misal semua yang isinya 0)
    $availablePlots = array_keys($counts, $minCount); 

    // Acak dari daftar yang paling sedikit tersebut
    $selectedPlotting = $availablePlots[array_rand($availablePlots)];
    // -----------------------------

    // Simpan ke Session
    session([
        'data_pendaftar' => [
            'nama' => $request->nama,
            'domisili' => $domisili,
            'gender' => $request->gender,
            'usia' => $request->usia,
            'pendidikan' => $request->pendidikan,
            'kecamatan' => $request->kecamatan,
            'pekerjaan' => $request->pekerjaan,
            'no_hp' => $request->no_hp,
            'plotting' => $selectedPlotting,
        ]
    ]);
    session()->save();

    if (strtolower($domisili) == 'makassar') {
        return redirect()->route('info.makassar');
    } else {
        return redirect()->route('info.toraja');
    }
}
    public function showPlotting()
    {
        // Ambil dari session
        $dataSession = session('data_pendaftar');

        // DEBUG: Jika data kosong, kita paksa balik ke form awal
        if (!$dataSession) {
            return redirect()->route('informasi.diri')->with('error', 'Data session hilang.');
        }

        $plotting = $dataSession['plotting'];

        $content = [
            'ITPT' => [
                'bg' => 'itpt_bg.PNG',
                'pajak' => 'TINGGI',
                'insentif' => 'TINGGI',
                'pajak_desc' => 'Menekan angka penyakit tidak menular (diabetes, obesitas, dll).',
                'insentif_desc' => 'Mendorong pola konsumsi sehat secara signifikan.',
            ],
            'IRPT' => [
                'bg' => 'irpt_bg.PNG',
                'pajak' => 'TINGGI',
                'insentif' => 'RENDAH',
                'pajak_desc' => 'Mengurangi konsumsi makanan berisiko tinggi.',
                'insentif_desc' => 'Potongan harga diberikan secara terbatas.',
            ],
            'IRPR' => [
                'bg' => 'irpr_bg.PNG',
                'pajak' => 'RENDAH',
                'insentif' => 'RENDAH',
                'pajak_desc' => 'Menjaga keseimbangan antara kesehatan dan ekonomi.',
                'insentif_desc' => 'Mendorong pola konsumsi sehat secara bertahap.',
            ],
            'ITPR' => [
                'bg' => 'itpr_bg.PNG',
                'pajak' => 'RENDAH',
                'insentif' => 'TINGGI',
                'pajak_desc' => 'Menjaga harga pasar tetap stabil namun terkendali.',
                'insentif_desc' => 'Mempermudah akses terhadap pilihan makanan sehat.',
            ],
        ];

        $viewData = $content[$plotting] ?? $content['IRPR'];

        return view('detail_plotting', [
            'data' => $viewData,
            'plotting' => $plotting
        ]);
    }
}