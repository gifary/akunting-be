<?php


namespace Tests\Feature\Filters;


use App\Filters\ParticipantFilters;
use App\Models\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\InteractsWithQueryFilters;

class ParticipantFiltersTest extends TestCase
{
    use RefreshDatabase, InteractsWithQueryFilters;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /** @test */
    public function filter_by_gender()
    {
        $participant = Participant::factory()->create(['gender' => 'ikhwan']);
        $participant2 = Participant::factory()->create(['gender' => 'akhwat']);

        $data = $this->setRequestFilters(
            Participant::class,
            ParticipantFilters::class,
            ['gender' => 'ikhwan']
        );

        $this->setResponseContent($data)
            ->assertJsonFragment(['id' => $participant->id])
            ->assertJsonMissing(['id' => $participant2->id]);
    }
}