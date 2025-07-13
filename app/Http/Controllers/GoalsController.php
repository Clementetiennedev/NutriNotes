<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        return view('goals.index', compact('user'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'goal' => 'required|in:cut,bulk,maintain'
        ]);

        auth()->user()->update(['goal' => $request->goal]);

        return redirect()->back()->with('success', 'Objectif mis à jour avec succès !');
    }
}
