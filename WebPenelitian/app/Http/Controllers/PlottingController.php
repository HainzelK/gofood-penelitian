<?php

namespace App\Http\Controllers;

use App\Services\PlottingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlottingController extends Controller
{
    protected $plottingService;
    
    public function __construct(PlottingService $plottingService)
    {
        $this->plottingService = $plottingService;
    }
    
    public function showInformasiDiri()
    {
        $user = Auth::user();
        $stats = $this->plottingService->getPlottingStats();
        
        return view('informasi_diri', compact('user', 'stats'));
    }
    
    public function storeInformasiDiri(Request $request)
    {
        $request->validate([
            'domisili' => 'required|in:Toraja,Makassar',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            // tambahkan validasi lain sesuai kebutuhan
        ]);
        
        $user = Auth::user();
        
        // Update informasi diri
        $user->update($request->only(['nama_lengkap', 'nomor_telepon']));
        
        // Assign plotting
        $result = $this->plottingService->assignPlotting($user, $request->domisili);
        
        if (!$result->getData()->success) {
            return back()->with('error', $result->getData()->message);
        }
        
        return redirect()->route('pilihan_restoran')
                        ->with('success', "Anda berhasil diplot ke {$result->getData()->plotting}");
    }
    
    public function showPilihanRestoran()
    {
        $user = Auth::user();
        
        // Cek apakah user sudah di-plot
        if (!$user->plotting || !$user->domisili) {
            return redirect()->route('informasi_diri')
                           ->with('error', 'Silakan lengkapi informasi diri terlebih dahulu');
        }
        
        return view('pilihan_restoran', compact('user'));
    }
    
    public function plottingStats()
    {
        $stats = $this->plottingService->getPlottingStats();
        return view('plotting_stats', compact('stats'));
    }
}