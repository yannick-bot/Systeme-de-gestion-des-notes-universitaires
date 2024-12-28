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
    ->only(['index', 'store', 'update', 'destroy', 'create'])
    ->middleware(['auth', 'verified']);


Route::resource('EC', ECController::class)
    ->only(['store', 'update', 'destroy', 'create'])
    ->middleware(['auth', 'verified']);

    // UE


//route vers la fonction qui envoie le formulaire pour éditer une UE
Route::get('UE/edit/{param}', [UEController::class, 'edit'])
    ->name('UE.edit')
    ->middleware(['auth', 'verified']);


    //EC

    //route vers la fonction qui récupère tous les ECs associés à l'ue_id pour l'index des ECS
Route::get('EC/index/{param}', [ECController::class, 'index'])
    ->name('EC.index')
    ->middleware(['auth', 'verified']);


    //route vers la fonction qui  envoie le formulaire pour éditer un EC
Route::get('EC/edit/{param}', [ECController::class, 'edit'])
    ->name('EC.edit')
    ->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
