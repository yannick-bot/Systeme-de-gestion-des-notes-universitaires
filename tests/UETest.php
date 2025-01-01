<?php

namespace Tests;
use App\Models\User;
use App\Models\UE;


use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


class UETest extends BaseTestCase
{
    // TEST 1
    public function test_de_creation_d_une_UE_valide() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $reponse = $this->followingRedirects()->post(route('UE.store'), [
            'code' => 'UE04',
            'nom' => 'ARITHMETIQUE',
            'credits_ects' => 15,
            'semestre' => 1,
        ]);
        $reponse->assertStatus(200);


        // Vérifier que le chirp a été ajouté à la base de données
        $this->assertDatabaseHas('u_e_s', [
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
        $reponse = $this->post(route('UE.store'), [
            'code' => 'UE68',
            'nom' => 'NE PASSE PAS',
            'credits_ects' => 97,
            'semestre' => 3
        ]);

        $reponse->assertSessionHasErrors(['credits_ects']);
    }

    //TEST 3 (Cela implique que lorsqu'on crée une UE on définisse au moins 1 EC)
    public function test_d_association_des_ECs_a_une_UE() {
        $user = User::factory()->create();
        $this->actingAs($user);
        $reponse = $this->post(route('UE.store'), [
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
        $reponse->assertRedirect(route('EC.create'));
        $reponse2 = $this->followingRedirects()
            ->post(route('EC.store'), [
                'code' => 'EC5',
                'nom' => 'Algebre lineaire',
                'coefficient' => 2,
                'ue_id' => $createdUeId
            ]);
        $reponse2->assertStatus(200); // Assure que le POST est traité correctement

    }

    //TEST 4
    function test_validation_du_code_UE() {
        $format = '/^UE[1-9]{2}$/';
        $user = User::factory()->create();
        $this->actingAs($user);
        $uE = UE::factory()->make();
        $reponse = $this->post(route('UE.store'), [
            'code' => $uE->code,
            'nom' => $uE->nom,
            'credits_ects' => 28,
            'semestre' => 3
        ]);
        if (preg_match($format, $uE->code) !== 1) {
            $reponse->assertSessionHasErrors(['code']);
        }
        else {
            $reponse->assertStatus(200);
        }
    }

    // TEST 5
    public function test_de_verification_du_semestre()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $uE = UE::factory()->create();

        $reponse = $this->post(route('UE.store'), [
            'code' => 'UE45',
            'nom' => $uE->nom,
            'credits_ects' => 2,
            'semestre' => $uE->semestre,
        ]);

        if ($uE->semestre < 1 || $uE->semestre > 6) {

            $reponse->assertSessionHasErrors(['semestre']);
        } else {
            $reponse->assertStatus(200); // Assurez-vous que l'UE est bien créée
        }
    }
}
