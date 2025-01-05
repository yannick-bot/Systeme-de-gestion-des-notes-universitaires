<?php
namespace App\Http\Controllers;

use App\Models\EC;
use App\Models\Note;
use Inertia\Inertia;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // Afficher la liste des notes
    public function index()
    {
        $notes = Note::with(['etudiant', 'ec'])->get();
        return Inertia::render('Notes/Index', [
            'notes' => $notes,
        ]);
    }

    // Formulaire de saisie de note
    public function create()
    {
        $ecs = EC::all();
        $etudiants = Etudiant::all(); // Récupère tous les étudiants

        return Inertia::render('Notes/Create', [
            'ecs' => $ecs,
            'etudiants' => $etudiants,
        ]);
    }

    // Enregistrer une note
    /*public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id', // Vérifie si l'étudiant existe
            'ec_id' => 'required|exists:elements_constitutifs,id',
            'note' => 'required|numeric|min:0|max:20',
            'session' => 'required|in:normale,rattrapage',
        ]);

        // Vérification si la note existe déjà pour cet étudiant et cet EC
        $existingNote = Note::where('etudiant_id', $validated['etudiant_id'])
            ->where('ec_id', $validated['ec_id'])
            ->where('session', $validated['session'])
            ->first();

        if ($existingNote) {
            //return back()->with('error', 'Cette note a déjà été enregistrée.');
            return response()->json(['error' => 'Cette note a déjà été enregistrée.'], 409);
        }

        // Si la note n'existe pas, on enregistre
        Note::create([
            'etudiant_id' => $validated['etudiant_id'],
            'ec_id' => $validated['ec_id'],
            'note' => $validated['note'],
            'session' => $validated['session'],
        ]);

        //return redirect()->route('notes.index')->with('success', 'Note enregistrée avec succès');
        return response()->json(['success' => 'Note enregistrée avec succès.'], 200);
    }*/

    public function store(Request $request)
    {
        Note::create($request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'ec_id' => 'required|exists:e_c_s,id',
            'note' => 'required|numeric|between:0,20',
            'session' => 'required|string',
            'date_evaluation' => 'required|date',
        ]));

        return response()->json(['message' => 'Note créée avec succès'], 200);
    }


    // Mettre à jour les notes de l'étudiant
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'notes' => 'required|array',
            'notes.*.ec_id' => 'required|exists:elements_constitutifs,id',
            'notes.*.note' => 'required|numeric|min:0|max:20',
        ]);

        foreach ($validated['notes'] as $noteData) {
            \App\Models\Note::updateOrCreate(
                ['etudiant_id' => $id, 'ec_id' => $noteData['ec_id']],
                ['note' => $noteData['note']]
            );
        }

        return redirect()->route('etudiants.show', $id)
            ->with('success', 'Notes mises à jour avec succès.');
    }

    // Afficher les résultats par semestre
    public function resultatsParSemestre()
    {
        $etudiants = Etudiant::with(['notes' => function ($query) {
            $query->groupBy('ec_id'); // Regroupe les notes par EC pour un étudiant
        }])->get();

        $resultats = [];

        foreach ($etudiants as $etudiant) {
            $moyenne_ue = 0;
            $total_coefficients = 0;

            foreach ($etudiant->notes as $note) {
                // On prend la meilleure note entre la session normale et de rattrapage
                $meilleure_note = $note->where('session', 'normale')->max('note');
                $note_rattrapage = $note->where('session', 'rattrapage')->max('note');

                $meilleure_note = max($meilleure_note, $note_rattrapage);

                // Calcul de la moyenne en prenant la note avec son coefficient
                $coeff = $note->ec->coefficient;
                $moyenne_ue += $meilleure_note * $coeff;
                $total_coefficients += $coeff;
            }

            $resultats[] = [
                'etudiant' => $etudiant,
                'moyenne' => $total_coefficients ? $moyenne_ue / $total_coefficients : 0,
            ];
        }

        return Inertia::render('Resultats/Semestre', [
            'resultats' => $resultats,
        ]);
    }

    // Afficher les notes de l'étudiant
    public function showNotes($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $notes = Note::with('ec.ue')
            ->where('etudiant_id', $id)
            ->get();

        return Inertia::render('NotesPage', [
            'etudiant' => $etudiant,
            'notes' => $notes,
        ]);
    }
}
