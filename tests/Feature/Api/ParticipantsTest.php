<?php


namespace Tests\Feature\Api;

use App\Models\Classes;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ParticipantsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->apiSignIn();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function can_get_list_of_participants()
    {
        $participant = Participant::factory()->count(2)->create();

        $this->getJson(route('api.participants.index'))
            ->assertJsonFragment(['id' => $participant->first()->id])
            ->assertJsonFragment(['id' => $participant->last()->id]);
    }

    /** @test */
    public function can_get_list_of_participants_with_paginate()
    {
        $participant = Participant::factory()->count(2)->create();

        $response = $this->getJson(route('api.participants.index',[
            'page' => 1,
            'per_page' => 10,
        ]))->assertSuccessful();

        $this->assertTrue($response->hasPaginationKeys());
    }



    /** @test */
    public function can_create_participant()
    {
        $this->postJson(route('api.participants.store'), [
            'name' => $name = 'gifary',
            'email' => $email = 'muhammadgifary@gmail.com',
            'nip' => $nip = '121524018',
            'phone_country_code' => '62',
            'phone' => '83821391320',
            'birth_date' => Carbon::now()->subYears(10)->toDateString(),
            'unique_code' => rand(0, 1000),
            'gender' => 'ikhwan',
            'status' => 'active',
            'billing_cycle' => '1'
        ]);

        $this->assertDatabaseHas('participants', [
            'name' => $name,
            'email' => $email,
            'nip' => $nip
        ]);
    }

    /** @test */
    public function can_create_participant_with_classes()
    {
        $classes = Classes::factory()->create();

        $response = $this->postJson(route('api.participants.store'), [
            'name' => $name = 'gifary',
            'email' => $email = 'muhammadgifary@gmail.com',
            'nip' => $nip = '121524018',
            'phone_country_code' => '62',
            'phone' => '83821391320',
            'birth_date' => Carbon::now()->subYears(10)->toDateString(),
            'unique_code' => rand(0, 1000),
            'gender' => 'ikhwan',
            'status' => 'active',
            'billing_cycle' => '1',
            'classes' => [$classes->id]
        ]);

        $participant = json_decode($response->getContent());

        $this->assertDatabaseHas('participants', [
            'name' => $name,
            'email' => $email,
            'nip' => $nip
        ]);

        $this->assertDatabaseHas('class_participants', [
            'classes_id' => $classes->id,
            'participant_id' => $participant->data->id,
        ]);
    }

    /** @test */
    public function can_get_participant_details()
    {
        $participant = Participant::factory()->create();

        $this->getJson(route('api.participants.show',
            $participant->id))->assertJsonFragment(['id' => $participant->id]);
    }

    /** @test */
    public function can_update_participant()
    {
        $participant = Participant::factory()->create();

        $this->putJson(route('api.participants.update',$participant->id),[
            'name' => $name = 'gifary',
            'email' => $email = 'muhammadgifary@gmail.com',
            'nip' => $nip = '121524018',
            'phone_country_code' => '62',
            'phone' => '83821391320',
            'birth_date' => Carbon::now()->subYears(10)->toDateString(),
            'unique_code' => rand(0, 1000),
            'gender' => 'ikhwan',
            'status' => 'active',
            'billing_cycle' => '1',
        ]);

        $this->assertDatabaseHas('participants', [
            'name' => $name,
            'email' => $email,
            'nip' => $nip
        ]);
    }

    /** @test */
    public function can_delete_a_participant()
    {
        $participant = Participant::factory()->create();

        $this->deleteJson(route('api.participants.destroy',$participant->id));

        $this->assertNotNull($participant->fresh()->deleted_at);
    }

    /** @test */
    public function can_restore_a_participant()
    {
        $participant = Participant::factory()->create();

        $this->patchJson(route('api.participants.restore',$participant->id));

        $this->assertNull($participant->fresh()->deleted_at);
    }
}