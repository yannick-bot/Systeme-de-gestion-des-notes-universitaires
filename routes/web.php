<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ECController;
use App\Http\Controllers\UEController;
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

//Route::resource('etudiants', EtudiantController::class);



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::resource('UE', UEController::class)
    ->only(['index', 'store', 'create'])
    ->middleware(['auth', 'verified']);


Route::resource('EC', ECController::class)
    ->only(['store', 'create'])
    ->middleware(['auth', 'verified']);

    // UE


//route vers la fonction qui envoie le formulaire pour éditer une UE
Route::get('UE/edit/{uE}', [UEController::class, 'edit'])
    ->name('UE.edit')
    ->middleware(['auth', 'verified']);

//route vers la fonction qui soumet le formulaire de l'UE édité
Route::patch('UE/{uE}', [UEController::class, 'update'])
    ->name('UE.update')
    ->middleware(['auth', 'verified']);

//route vers la fonction qui gère la suppression d'un EC
Route::delete('UE/{uE}', [UEController::class, 'destroy'])
    ->name('UE.destroy')
    ->middleware(['auth', 'verified']);


    //EC

    //route vers la fonction qui récupère tous les ECs associés à l'ue_id pour l'index des ECS
Route::get('EC/index/{id}', [ECController::class, 'index'])
    ->name('EC.index')
    ->middleware(['auth', 'verified']);


    //route vers la fonction qui  envoie le formulaire pour éditer un EC
Route::get('EC/edit/{id}', [ECController::class, 'edit'])
    ->name('EC.edit')
    ->middleware(['auth', 'verified']);

    //route vers la fonction qui soumet le formulaire de l'EC édité
Route::patch('EC/{ec}', [ECController::class, 'update'])
    ->name('EC.update')
    ->middleware(['auth', 'verified']);

    //route vers la fonction qui gère la suppression d'un EC
Route::delete('EC/{eC}', [ECController::class, 'destroy'])
    ->name('EC.destroy')
    ->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
