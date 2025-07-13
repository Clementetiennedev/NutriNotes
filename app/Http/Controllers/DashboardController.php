<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stat;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Récupérer la période sélectionnée (par défaut 7 jours)
        $period = $request->get('period', '7');
        
        // Trier par date ET par created_at pour avoir le bon ordre
        $stats = $user->stats()
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // Pour le dernier poids et la variation
        $latestWeightStat = $user->stats()
            ->whereNotNull('weight')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->first();
            
        $secondLatestWeightStat = $user->stats()
            ->whereNotNull('weight')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->first();
            
        $latestWeight = $latestWeightStat?->weight;
        $weightTrend = null;
        
        if ($latestWeightStat && $secondLatestWeightStat) {
            $weightDiff = $latestWeight - $secondLatestWeightStat->weight;
            $weightTrend = [
                'direction' => $weightDiff > 0 ? 'up' : ($weightDiff < 0 ? 'down' : 'stable'),
                'value' => abs($weightDiff)
            ];
        }
            
        // Calculer la date limite selon la période
        $query = $user->stats();
        $periodLabel = '';
        
        switch($period) {
            case '7':
                $query = $query->where('date', '>=', Carbon::now()->subDays(7));
                $periodLabel = '7j';
                break;
            case '30':
                $query = $query->where('date', '>=', Carbon::now()->subDays(30));
                $periodLabel = '30j';
                break;
            case 'all':
                // Pas de filtre de date
                $periodLabel = 'Tout';
                break;
        }
        
        // Calories moyennes selon la période
        $avgCalories = (clone $query)->whereNotNull('calories')->avg('calories');
        
        // Pas moyens selon la période
        $avgSteps = (clone $query)->whereNotNull('steps')->avg('steps');
            
        $totalEntries = $user->stats()->count();

        return view('dashboard', compact('stats', 'latestWeight', 'weightTrend', 'avgCalories', 'avgSteps', 'totalEntries', 'period', 'periodLabel'));
    }
}
