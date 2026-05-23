// app/Services/PlottingService.php
namespace App\Services;

use App\Models\Plotting;
use App\Models\User;

class PlottingService
{
    private $plottingNames = ['ITPT', 'IRPT', 'IRPR', 'ITPR'];
    private $locations = ['Toraja', 'Makassar'];
    private $maxPerPlotting = 30;
    private $maxPerLocation = 30;
    
    public function assignPlotting(User $user, $domisili)
    {
        // Cek apakah plotting sudah pernah di-assign
        if ($user->plotting && $user->domisili) {
            return response()->json([
                'success' => false,
                'message' => 'Plotting sudah ditentukan dan tidak bisa diubah'
            ], 403);
        }
        
        // Cek kuota domisili
        if (!$this->checkLocationQuota($domisili)) {
            return response()->json([
                'success' => false,
                'message' => "Kuota untuk $domisili sudah penuh (maksimal {$this->maxPerLocation} orang)"
            ], 422);
        }
        
        // Dapatkan plotting terbaik
        $plotting = $this->getBestAvailablePlotting($domisili);
        
        if (!$plotting) {
            return response()->json([
                'success' => false,
                'message' => 'Semua plotting sudah penuh'
            ], 422);
        }
        
        // Assign plotting ke user
        $user->update([
            'plotting' => $plotting,
            'domisili' => $domisili
        ]);
        
        return response()->json([
            'success' => true,
            'message' => "Berhasil diplot ke $plotting",
            'plotting' => $plotting,
            'domisili' => $domisili
        ]);
    }
    
    private function getBestAvailablePlotting($domisili)
    {
        $availablePlottings = [];
        
        foreach ($this->plottingNames as $plottingName) {
            $currentCount = User::where('plotting', $plottingName)
                               ->where('domisili', $domisili)
                               ->count();
            
            if ($currentCount < $this->maxPerPlotting) {
                $availablePlottings[] = [
                    'name' => $plottingName,
                    'count' => $currentCount
                ];
            }
        }
        
        if (empty($availablePlottings)) {
            return null;
        }
        
        // Urutkan berdasarkan jumlah terkecil (untuk distribusi merata)
        usort($availablePlottings, function($a, $b) {
            return $a['count'] <=> $b['count'];
        });
        
        return $availablePlottings[0]['name'];
    }
    
    private function checkLocationQuota($domisili)
    {
        $count = User::where('domisili', $domisili)->count();
        return $count < $this->maxPerLocation;
    }
    
    public function getPlottingStats()
    {
        $stats = [];
        
        foreach ($this->plottingNames as $plottingName) {
            foreach ($this->locations as $location) {
                $count = User::where('plotting', $plottingName)
                            ->where('domisili', $location)
                            ->count();
                
                $stats[] = [
                    'plotting' => $plottingName,
                    'location' => $location,
                    'count' => $count,
                    'available' => $this->maxPerPlotting - $count,
                    'percentage' => ($count / $this->maxPerPlotting) * 100
                ];
            }
        }
        
        // Total per lokasi
        foreach ($this->locations as $location) {
            $totalLocation = User::where('domisili', $location)->count();
            $stats[] = [
                'plotting' => 'TOTAL',
                'location' => $location,
                'count' => $totalLocation,
                'available' => $this->maxPerLocation - $totalLocation,
                'percentage' => ($totalLocation / $this->maxPerLocation) * 100,
                'is_total' => true
            ];
        }
        
        return $stats;
    }
}