<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoalsController;

// Page d'accueil - formulaire login/register si pas connecté, sinon dashboard
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('welcome'); // Page avec login/register
})->name('home');

// Redirection pour /login en GET vers l'accueil
Route::get('/login', function () {
    session()->flash('auth_required', 'Utilisez le formulaire ci-dessous pour vous connecter. 🔐');
    return redirect()->route('home');
});

// Routes d'authentification
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes protégées - UTILISE LE MIDDLEWARE STANDARD
Route::middleware('auth')->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestion des statistiques - RESOURCE COMPLET
    Route::resource('stats', StatsController::class);

    // Nouvelles routes pour les objectifs
    Route::get('/goals', [GoalsController::class, 'index'])->name('goals.index');
    Route::post('/goals/update', [GoalsController::class, 'update'])->name('goals.update');
});

