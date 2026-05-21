<?php

namespace App\Http\Controllers;

use App\Models\Restoran;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RestoranController extends Controller
{
    /**
     * Display a listing of the restaurants, optionally filtered by jenis (HF / TGGL).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Restoran::query();

        // Optional filter by 'jenis' (HF or TGGL)
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
     * Display the menus of a specific restaurant.
     *
     * @param  int  $idrestoran
     * @return \Illuminate\Http\JsonResponse
     */
    public function showMenus($idrestoran): JsonResponse
    {
        $restoran = Restoran::find($idrestoran);

        if (!$restoran) {
            return response()->json([
                'status' => 'error',
                'message' => 'Restoran not found'
            ], 404);
        }

        // Get menus for the restaurant
        $menus = $restoran->menus;

        return response()->json([
            'status' => 'success',
            'restaurant' => $restoran,
            'data' => $menus
        ]);
    }
}
