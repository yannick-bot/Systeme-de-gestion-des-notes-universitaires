<?php

use App\Http\Controllers\UEController;
use App\Http\Controllers\ECController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
