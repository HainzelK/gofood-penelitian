<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JawabanResponden;
use Illuminate\Support\Facades\DB;

class PlottingController extends Controller
{
public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama' => 'required',
            'domisili' => 'required',
            'no_hp' => 'required',
        ]);

        $domisili = $request->domisili;
        $listPlotting = ['ITPT', 'IRPT', 'IRPR', 'ITPR'];
        $limit = 30;

        // 2. Logika Distribusi Rata & Randomize
        $counts = [];
        foreach ($listPlotting as $plot) {
            $count = User::where('domisili', $domisili)
                         ->where('plotting', $plot)
                         ->count();
            if ($count < $limit) {
                $counts[$plot] = $count;
            }
        }

        if (empty($counts)) {
            return back()->with('error', 'Kuota untuk wilayah ' . $domisili . ' sudah penuh.');
        }

        $minCount = min($counts);
        $availablePlots = array_keys($counts, $minCount);
        $selectedPlotting = $availablePlots[array_rand($availablePlots)];

        // --- HANYA SIMPAN KE TABEL USERS SESUAI GAMBAR ---
        User::create([
            'name'       => $request->nama,
            'plotting'   => $selectedPlotting,
            'domisili'   => $domisili,
            'no_hp'      => str_replace(' ', '', $request->no_hp),
            'gender'     => $request->gender,
            'pendidikan' => $request->pendidikan,
            'kecamatan'  => $request->kecamatan,
            'pekerjaan'  => $request->pekerjaan,
        ]);
        // ------------------------------------------------

        // 3. Simpan ke Session
        session([
            'data_pendaftar' => [
                'nama' => $request->nama,
                'gender' => $request->gender,
                'usia' => $request->usia,
                'pendidikan' => $request->pendidikan,
                'domisili' => $domisili,
                'kecamatan' => $request->kecamatan,
                'pekerjaan' => $request->pekerjaan,
                'no_hp' => $request->no_hp,
                'plotting' => $selectedPlotting,
            ]
        ]);
        session()->save();

        // 4. Redirect berdasarkan domisili
        if (strtolower($domisili) == 'makassar') {
            return redirect()->route('info.makassar');
        } else {
            return redirect()->route('info.toraja');
        }
    }

    public function showPlotting()
    {
        $dataSession = session('data_pendaftar');

        if (!$dataSession) {
            return redirect()->route('informasi.diri');
        }

        $plotting = $dataSession['plotting'];

        $content = [
            'ITPT' => [
                'bg' => 'itpt_bg.PNG',
                'pajak' => 'TINGGI',
                'insentif' => 'TINGGI',
                'icon_pajak' => 'tggl_mahal.png', 
                'icon_insentif' => 'hf_naik.png', 
                'pajak_desc' => 'Menekan angka penyakit tidak menular (diabetes, obesitas, dll).',
                'insentif_desc' => 'Mendorong pola konsumsi sehat secara signifikan.',
            ],
            'IRPT' => [
                'bg' => 'irpt_bg.PNG',
                'pajak' => 'TINGGI',
                'insentif' => 'RENDAH',
                'icon_pajak' => 'tggl_mahal.png',
                'icon_insentif' => 'hf_murah.png',
                'pajak_desc' => 'Mengurangi konsumsi makanan berisiko tinggi.',
                'insentif_desc' => 'Potongan harga diberikan secara terbatas.',
            ],
            'IRPR' => [
                'bg' => 'irpr_bg.PNG',
                'pajak' => 'RENDAH',
                'insentif' => 'RENDAH',
                'icon_pajak' => 'tggl_murah.png',
                'icon_insentif' => 'hf_murah.png',
                'pajak_desc' => 'Menjaga keseimbangan antara kesehatan dan ekonomi.',
                'insentif_desc' => 'Mendorong pola konsumsi sehat secara bertahap.',
            ],
            'ITPR' => [
                'bg' => 'itpr_bg.PNG',
                'pajak' => 'RENDAH',
                'insentif' => 'TINGGI',
                'icon_pajak' => 'tggl_murah.png',
                'icon_insentif' => 'hf_naik.png',
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

    public function prosesBayar(Request $request)
    {
        $dataSession = session('data_pendaftar');

        if (!$dataSession) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Silakan isi informasi diri ulang.'
            ], 422);
        }

        try {
            JawabanResponden::create([
                'Tanggal'            => now()->toDateString(),
                'IS'                 => 'Setuju',
                'Nama'               => $dataSession['nama'],
                'Gender'             => $dataSession['gender'],
                'Usia'               => $dataSession['usia'],
                'PendidikanTerakhir' => $dataSession['pendidikan'],
                'DaerahDomisili'     => $dataSession['domisili'],
                'Kecamatan'          => $dataSession['kecamatan'],
                'Pekerjaan'          => $dataSession['pekerjaan'],
                'NoHP'               => $dataSession['no_hp'],
                'Plotting'           => $dataSession['plotting'],
                'Saldo'              => $request->input('saldo', 0),
                'MenuMakanan'        => $request->input('menu_makanan', 0),
                'MenuMinuman'        => $request->input('menu_minuman', 0),
                'Subsidi/Insentif'   => $request->input('subsidi_insentif', 0),
                'Pajak'              => $request->input('pajak', 0),
                'Total'              => $request->input('total', 0),
                'TopUp'              => $request->input('top_up', 0),
                'TIME_CASE_PRES'     => $request->input('time_case_pres', '00:00:00'),
                'TIME_ALL'           => $request->input('time_all', '00:00:00'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
}