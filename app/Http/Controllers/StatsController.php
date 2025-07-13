<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', '30'); // Par défaut 30 jours
        
        // Récupérer les données selon la période
        $query = auth()->user()->stats()->orderBy('date', 'asc');
        
        switch($period) {
            case '7':
                $query = $query->where('date', '>=', Carbon::now()->subDays(7));
                $periodLabel = '7 derniers jours';
                break;
            case '30':
                $query = $query->where('date', '>=', Carbon::now()->subDays(30));
                $periodLabel = '30 derniers jours';
                break;
            case 'all':
                $periodLabel = 'Toutes les données';
                break;
        }
        
        $stats = $query->get();
        
        // Préparer les données pour les graphiques
        $chartData = [
            'labels' => $stats->pluck('date')->map(fn($date) => $date->format('d/m'))->toArray(),
            'weight' => $stats->pluck('weight')->toArray(),
            'calories' => $stats->pluck('calories')->toArray(),
            'steps' => $stats->pluck('steps')->toArray(),
        ];
        
        // Statistiques générales
        $totalEntries = auth()->user()->stats()->count();
        $firstEntry = auth()->user()->stats()->orderBy('date')->first();
        $lastEntry = auth()->user()->stats()->orderBy('date', 'desc')->first();
        
        return view('stats.index', compact('stats', 'chartData', 'period', 'periodLabel', 'totalEntries', 'firstEntry', 'lastEntry'));
    }

    public function create()
    {
        return view('stats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric|min:0|max:999.99',
            'calories' => 'required|integer|min:0|max:9999',
            'steps' => 'nullable|integer|min:0|max:999999',
            'notes' => 'nullable|string|max:1000',
        ]);

        auth()->user()->stats()->create($request->only(['weight', 'calories', 'steps', 'notes', 'date']));

        return redirect()->route('dashboard')->with('success', 'Statistique ajoutée avec succès !');
    }

    public function edit(Stat $stat)
    {
        // Vérifier que la stat appartient à l'utilisateur connecté
        if ($stat->user_id !== auth()->id()) {
            abort(403);
        }

        return view('stats.edit', compact('stat'));
    }

    public function update(Request $request, Stat $stat)
    {
        // Vérifier que la stat appartient à l'utilisateur connecté
        if ($stat->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric|min:0|max:999.99',
            'calories' => 'required|integer|min:0|max:9999',
            'steps' => 'nullable|integer|min:0|max:999999',
            'notes' => 'nullable|string|max:1000',
        ]);

        $stat->update($request->only(['weight', 'calories', 'steps', 'notes', 'date']));

        return redirect()->route('dashboard')->with('success', 'Statistique modifiée avec succès !');
    }

    public function destroy(Stat $stat)
    {
        // Vérifier que la stat appartient à l'utilisateur connecté
        if ($stat->user_id !== auth()->id()) {
            abort(403);
        }

        $stat->delete();

        return redirect()->back()->with('success', 'Statistique supprimée avec succès !');
    }
}
