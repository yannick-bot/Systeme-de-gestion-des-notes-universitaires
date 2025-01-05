<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Etudiant;
use App\Models\EC;
use App\Models\Note;

class NoteTest extends TestCase
{
    /**
     * Test: Ajout d'une note valide.
     */
    public function test_ajout_note_valide()
    {
        // Créer un étudiant factice
        $etudiant = Etudiant::factory()->create();

        // Créer un EC factice
        $ec = EC::factory()->create();

        // Effectuer une requête POST pour ajouter une note
        $response = $this->post('/notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15,
            'session' => 'normale',
            'date_evaluation' => now()->toDateString(),
        ]);

        // Vérifiez que la réponse est correcte
        $response->assertStatus(200);

        // Vérifiez que la note a bien été enregistrée dans la base de données
        $this->assertDatabaseHas('notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15,
        ]);
    }
}
