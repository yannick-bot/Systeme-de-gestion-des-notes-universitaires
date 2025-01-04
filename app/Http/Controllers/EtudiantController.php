<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $etudiants = Etudiant::all();
        return Inertia::render('etudiants/index', [
            'etudiants' => $etudiants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('etudiants/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'numero_etudiant' => 'required|unique:etudiants',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'niveau' => 'required|in:L1,L2,L3',
    ]);

    Etudiant::create($validated);

    return redirect()->route('etudiants.index')
        ->with('success', 'Étudiant ajouté avec succès.');
}


    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        return Inertia::render('etudiants/show', [
            'etudiant' => $etudiant,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        return Inertia::render('etudiants/edit', [
            'etudiant' => $etudiant,
        ]);
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'numero_etudiant' => 'required|unique:etudiants,numero_etudiant,' . $etudiant->id,
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'niveau' => 'required|in:L1,L2,L3',
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès.');
    }

}
