<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateGoal(Request $request)
    {
        $request->validate([
            'goal' => 'required|in:cut,bulk,maintain'
        ]);

        auth()->user()->update(['goal' => $request->goal]);

        return redirect()->back()->with('success', 'Objectif mis à jour !');
    }
}
