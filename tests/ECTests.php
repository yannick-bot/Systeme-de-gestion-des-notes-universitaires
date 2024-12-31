<?php

namespace Tests;
use App\Models\EC;
use App\Models\User;
use App\Models\UE;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class ECTests extends BaseTestCase
{
    //TEST 1
    function test_de_creation_d_un_EC_valide() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $uE = UE::factory()->create();

        $this->followingRedirects()
            ->post('EC/create', [
                'code' => 'EC02',
                'nom' => 'Arithmétique 1',
                'coefficient' => 3,
                'ue_id' => $uE->id,
            ])
            ->assertStatus(200)
            ->assertSee($uE->code);
    }

    //TEST 2
    function test_de_verification_du_rattachement_d_un_EC_a_une_UE() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->followingRedirects()->post('EC/create', [
            'code' => 'EC01',
            'nom' => 'Arithmétique 2',
            'coefficient' => 3,
            'ue_id' => null,
        ])
        ->assertSessionHasErrors(['ue_id']);
    }

    // TEST 3
    function test_de_modification_d_un_EC() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $uE = UE::factory()->create();

        $eC = EC::factory()->create([
            'ue_id' => $uE->id
        ]);

        $this->followingRedirects()->patch("EC/edit/{$eC}", [
            'code' => 'EC01',
            'nom' => 'Arithmétique 2',
            'coefficient' => 3,
            'ue_id' => $eC->ue_id,
        ])
            ->assertStatus(200)
            ->assertDatabaseHas('e_c_s', [
                'id' => $eC->id,
                'code' => 'EC01',
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

        $reponse = $this->followingRedirects()->post('EC/create', [
            'code' => 'EC01',
            'nom' => 'Arithmétique 2',
            'coefficient' => $eC->coefficient,
            'ue_id' => $eC->ue_id,
        ]);

        if($eC->coefficient < 1 || $eC->coefficient > 5) {
            $reponse->assertSessionHasErrors(['coefficient']);
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
            ->delete("EC/{$eC}")
            ->assertStatus(200);
        $this->assertDatabaseMissing('e_c_s', [
            'id' => $eC->id
        ]);
    }
}
