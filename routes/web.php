<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EtudiantController;

// Route de la page d'accueil
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Tableau de bord après authentification
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour le profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour la gestion des étudiants
Route::middleware('auth')->group(function () {
    // Liste des étudiants
    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');

    // Formulaire d'ajout d'un étudiant
    Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');

    // Enregistrement d'un nouvel étudiant
    Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');

    // Formulaire de modification d'un étudiant
    Route::get('/etudiants/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');

    // Mise à jour d'un étudiant existant
    Route::put('/etudiants/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');

    // Suppression d'un étudiant
    Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
});

require __DIR__.'/auth.php';

//Route::resource('etudiants', EtudiantController::class);

