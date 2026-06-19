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
        // Hilangkan spasi pada no_hp sebelum divalidasi
        if ($request->has('no_hp')) {
            $request->merge([
                'no_hp' => str_replace(' ', '', $request->no_hp)
            ]);
        }

        $inputPhone = $request->no_hp;
        $existingPhone = session('data_pendaftar.no_hp');
        
        $userId = null;
        if ($existingPhone) {
            $user = User::where('no_hp', $existingPhone)->first();
            if ($user) {
                $userId = $user->id;
            }
        }

        // 1. Validasi Input (Fingerprint dihapus)
        $request->validate([
            'nama' => 'required',
            'domisili' => 'required',
            'domisili_lainnya' => 'required_if:domisili,Lainnya|max:100',
            'no_hp' => 'unique:users,no_hp' . ($userId ? ',' . $userId : ''), 
        ], [
            'no_hp.unique' => 'Nomor Handphone ini sudah terdaftar.',
            'domisili_lainnya.required_if' => 'Nama daerah domisili harus diisi.',
            'domisili_lainnya.max' => 'Nama daerah maksimal 100 karakter.'
        ]);

        // Tentukan nilai domisili yang akan disimpan
        $domisiliSimpan = ($request->domisili === 'Lainnya') ? $request->domisili_lainnya : $request->domisili;

        if ($userId) {
            // Jika sudah ada di session, update data tanpa menghitung plotting ulang
            $user = User::find($userId);
            $selectedPlotting = $user->plotting;
            
            $user->update([
                'name'       => $request->nama,
                'domisili'   => $domisiliSimpan,
                'no_hp'      => $inputPhone,
                'gender'     => $request->gender,
                'pendidikan' => $request->pendidikan,
                'kecamatan'  => $request->kecamatan,
                'pekerjaan'  => $request->pekerjaan,
            ]);
        } else {
            $listPlotting = ['ITPT', 'IRPT', 'IRPR', 'ITPR'];

            // 2. Logika Distribusi Rata & Randomize
            $counts = [];
            foreach ($listPlotting as $plot) {
                $counts[$plot] = User::where('domisili', $domisiliSimpan)
                             ->where('plotting', $plot)
                             ->count();
            }


            $minCount = min($counts);
            $availablePlots = array_keys($counts, $minCount);
            $selectedPlotting = $availablePlots[array_rand($availablePlots)];

            User::create([
                'name'       => $request->nama,
                'plotting'   => $selectedPlotting,
                'domisili'   => $domisiliSimpan,
                'no_hp'      => $inputPhone,
                'gender'     => $request->gender,
                'pendidikan' => $request->pendidikan,
                'kecamatan'  => $request->kecamatan,
                'pekerjaan'  => $request->pekerjaan,
            ]);
        }

        // 3. Simpan ke Session
        session([
            'data_pendaftar' => [
                'nama' => $request->nama,
                'gender' => $request->gender,
                'usia' => $request->usia,
                'pendidikan' => $request->pendidikan,
                'domisili' => $domisiliSimpan,
                'kecamatan' => $request->kecamatan,
                'pekerjaan' => $request->pekerjaan,
                'no_hp' => $inputPhone,
                'plotting' => $selectedPlotting,
            ]
        ]);
        session()->save();

        // 4. Redirect berdasarkan domisili
        $domisiliUtama = strtolower($domisiliSimpan); 
        $gender = $request->gender;

        if ($domisiliUtama === 'makassar') {
            return redirect()->route('info.makassar');
        } elseif ($domisiliUtama === 'toraja') {
            return redirect()->route('info.toraja');
        } else {
            if ($gender === 'Perempuan') {
                return redirect()->route('info.toraja');
            } else {
                return redirect()->route('info.makassar');
            }
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
                'bg' => 'itpt_desktop.PNG',
                'pajak' => 'TINGGI',
                'insentif' => 'TINGGI',
                'icon_pajak' => 'tggl_mahal.png', 
                'icon_insentif' => 'hf_naik.png', 
                'pajak_desc' => 'Menekan angka penyakit tidak menular (diabetes, obesitas, dll).',
                'insentif_desc' => 'Mendorong pola konsumsi sehat secara signifikan.',
            ],
            'IRPT' => [
                'bg' => 'irpt_desktop.PNG',
                'pajak' => 'TINGGI',
                'insentif' => 'RENDAH',
                'icon_pajak' => 'tggl_mahal.png',
                'icon_insentif' => 'hf_murah.png',
                'pajak_desc' => 'Mengurangi konsumsi makanan berisiko tinggi.',
                'insentif_desc' => 'Potongan harga diberikan secara terbatas.',
            ],
            'IRPR' => [
                'bg' => 'irpr_desktop.PNG',
                'pajak' => 'RENDAH',
                'insentif' => 'RENDAH',
                'icon_pajak' => 'tggl_murah.png',
                'icon_insentif' => 'hf_murah.png',
                'pajak_desc' => 'Menjaga keseimbangan antara kesehatan dan ekonomi.',
                'insentif_desc' => 'Mendorong pola konsumsi sehat secara bertahap',
            ],
            'ITPR' => [
                'bg' => 'itpr_desktop.PNG',
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

            session()->forget('data_pendaftar');
            
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