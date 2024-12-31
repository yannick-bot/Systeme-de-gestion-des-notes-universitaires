<?php

namespace Tests;
use App\Models\User;
use App\Models\UE;


use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


abstract class UETests extends BaseTestCase
{
    // TEST 1
    public function test_de_creation_d_une_UE_valide() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $reponse = $this->post('/UE/create', [
            'code' => 'UE04',
            'nom' => 'ARITHMETIQUE',
            'credits_ects' => 15,
            'semestre' => 1,
        ]);
        $reponse->assertStatus(302);
        // Suivre la redirection et vérifier le statut final
        $suiviReponse = $this->get($reponse->headers->get('Location'));
        $suiviReponse->assertStatus(200);
        // Vérifier que le chirp a été ajouté à la base de données
        $this->assertDatabaseHas('chirps', [
            'code' => 'UE04',
            'nom' => 'ARITHMETIQUE',
            'credits_ects' => 15,
            'semestre' => 1,
        ]);
    }

    // TEST 2


    public function test_de_verification_des_credits_ECTS() {
        $user = User::factory()->create();
        $this->actingAs($user);
        $uE = UE::factory()->create();
        $reponse = $this->post('/UE/create', [
            'code' => $uE->code,
            'nom' => $uE->nom,
            'credits_ects' => $uE->credits_ects,
            'semestre' => $uE->semestre
        ]);
        if($uE->credits_ects < 1 || $uE->credits_ects > 30) {
            $reponse->assertSessionHasErrors(['credits_ects']);
        }
    }

    //TEST 3 (Cela implique que lorsqu'on crée une UE on définisse au moins 1 EC)
    public function test_d_association_des_ECs_a_une_UE() {
        $user = User::factory()->create();
        $this->actingAs($user);
        $reponse = $this->post('/UE/create', [
            'code' => 'UE12',
            'nom' => 'ALGEBRE',
            'credits_ects' => 4,
            'semestre' => 1
        ]);


        // Récupère l'enregistrement de la base de données
        $createdUe = UE::where('code', 'UE12')->first();

        // Vérifie que l'ID de l'UE créée est récupéré
        $this->assertNotNull($createdUe);
        $this->assertIsInt($createdUe->id);

        $createdUeId = $createdUe->id;

        // Vérifie que la réponse redirige vers l'URL spécifiée
        $reponse->assertRedirect('/EC/create');
        $this->followingRedirects()
            ->post('/EC/create', [
                'code' => 'EC5',
                'nom' => 'Algebre lineaire',
                'coefficient' => 2,
                'ue_id' => $createdUeId
            ])
            ->assertStatus(200); // Assure que le POST est traité correctement

    }

    //TEST 4 NB: Ecrire un regex pour valider le format
    function test_validation_du_code_UE() {
        $format = '/^UE[1-9]{2}$/';
        $user = User::factory()->create();
        $this->actingAs($user);
        $uE = UE::factory()->create();
        $reponse = $this->followingRedirects()->post('/UE/create', [
            'code' => $uE->code,
            'nom' => $uE->nom,
            'credits_ects' => $uE->credits_ects,
            'semestre' => $uE->semestre
        ]);
        if (preg_match($format, $uE->code) !== 1) {
            $reponse->assertSessionHasErrors(['code']);
        }
        else {
            $reponse->assertStatus(200);
        }
    }

    // TEST 5
    function test_de_verification_du_semestre() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $uE = UE::factory()->create();
        $reponse = $this->followingRedirects()->post('/UE/create', [
            'code' => $uE->code,
            'nom' => $uE->nom,
            'credits_ects' => $uE->credits_ects,
            'semestre' => $uE->semestre
        ]);
        if ($uE->semestre < 1 || $uE->semestre > 6) {
            $reponse->assertSessionHasErrors(['semestre']);
        } else {
            $reponse->assertStatus(200);
        }
    }
}
