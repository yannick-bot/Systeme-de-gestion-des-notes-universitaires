<?php

namespace Tests;
use App\Models\EC;
use App\Models\User;
use App\Models\UE;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class ECTest extends BaseTestCase
{
    //TEST 1
    function test_de_creation_d_un_EC_valide() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $uE = UE::factory()->create();

        $this->followingRedirects()
            ->post(route('EC.store'), [
                'code' => 'EC02',
                'nom' => 'Arithmétique 1',
                'coefficient' => 3,
                'ue_id' => $uE->id,
            ])
            ->assertStatus(200);

    }

    //TEST 2
    function test_de_verification_du_rattachement_d_un_EC_a_une_UE() {
        $user = User::factory()->create();
        $this->actingAs($user);



        $reponse = $this->post('/EC', [
            'code' => 'EC01',
            'nom' => 'Arithmétique 2',
            'coefficient' => 3,
            'ue_id' => null,
        ]);
        $reponse->assertSessionHasErrors(['ue_id']);  
    }

    // TEST 3
    public function test_de_modification_d_un_EC()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $uE = UE::factory()->create();

        $eC = EC::factory()->create([
            'code' => 'EC95',
            'nom' => 'Arithmétique 2',
            'coefficient' => 3,
            'ue_id' => $uE->id,
        ]);

        $reponse = $this->followingRedirects()->patch(route('EC.update', $eC->id), [
            'code' => 'EC95',
            'nom' => 'Arithmétique 2',
            'coefficient' => 3,
            'ue_id' => $eC->ue_id,
        ]);


        $reponse->assertStatus(200);


        $this->assertDatabaseHas('e_c_s', [
            'id' => $eC->id,
            'code' => 'EC95',
            'nom' => 'Arithmétique 2',
            'coefficient' => 3,
            'ue_id' => $eC->ue_id,
        ]);
    }

    // TEST 4
    function test_de_validation_du_coefficient() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $uE = UE::factory()->create();

        $eC = EC::factory()->create([
            'ue_id' => $uE->id
        ]);

        $reponse = $this->post('/EC', [
            'code' => 'EC05',
            'nom' => $eC->nom,
            'coefficient' => $eC->coefficient,
            'ue_id' => $eC->ue_id,
        ]);
        if($eC->coefficient < 1 || $eC->coefficient > 5) {
            $reponse->assertSessionHasErrors(['coefficient']);
        }
        else {
            $reponse->assertStatus(200);
        }

    }

    // TEST 5
    function test_de_suppression_d_un_EC() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $uE = UE::factory()->create();

        $eC = EC::factory()->create([
            'ue_id' => $uE->id
        ]);

        $this->followingRedirects()
            ->delete("/EC/{$eC->id}")
            ->assertStatus(200);
        $this->assertDatabaseMissing('e_c_s', [
            'id' => $eC->id
        ]);
    }
}
