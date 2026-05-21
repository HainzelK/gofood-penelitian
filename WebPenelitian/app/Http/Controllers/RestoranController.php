<?php

namespace App\Http\Controllers;

use App\Models\Restoran;
use App\Models\Menu; // Pastikan model Menu di-import
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RestoranController extends Controller
{
    /**
     * API: Mengambil daftar restoran (JSON).
     * Bisa difilter berdasarkan ?jenis=HF atau ?jenis=TGGL
     */
    public function index(Request $request): JsonResponse
    {
        $query = Restoran::query();

        if ($request->has('jenis')) {
            $jenis = strtoupper($request->query('jenis'));
            if (in_array($jenis, ['HF', 'TGGL'])) {
                $query->where('Jenis', $jenis);
            }
        }

        $restoran = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $restoran
        ]);
    }

    /**
     * WEB: Menampilkan halaman daftar restoran berdasarkan jenis (Blade).
     */
    public function showByJenis($jenis)
    {
        $jenis = strtoupper($jenis);
        
        // Ambil data restoran berdasarkan jenis
        $restoran = Restoran::where('Jenis', $jenis)->get();
        
        // Judul halaman
        $title = ($jenis == 'HF') ? 'Menu Sehat' : 'Menu Reguler';
        
        return view('pilihan_restoran', compact('restoran', 'title', 'jenis'));
    }

    /**
     * WEB (BARU): Menampilkan halaman daftar menu restoran tertentu (Blade).
     * Digunakan saat user mengklik kartu restoran.
     */
    public function showMenuPage($idrestoran)
    {
        // Menggunakan Eager Loading 'menus' agar lebih cepat
        // Pastikan di model Restoran sudah ada relasi: public function menus()
        $restoran = Restoran::with('menus')->find($idrestoran);

        if (!$restoran) {
            abort(404, 'Restoran tidak ditemukan');
        }

        $menuItems = $restoran->menus;

        return view('menu_restoran', compact('restoran', 'menuItems'));
    }

    /**
     * API: Mengambil data menu restoran tertentu (JSON).
     * Berguna jika Anda ingin melakukan fetch data via JavaScript/AJAX.
     */
    public function showMenus($idrestoran): JsonResponse
    {
        $restoran = Restoran::with('menus')->find($idrestoran);

        if (!$restoran) {
            return response()->json([
                'status' => 'error',
                'message' => 'Restoran not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'restaurant' => $restoran,
            'data' => $restoran->menus
        ]);
    }
}