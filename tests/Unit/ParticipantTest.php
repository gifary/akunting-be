<?php


namespace Tests\Unit;


use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class ParticipantTest extends TestCase
{
    private $participant;

    protected function setUp() : void
    {
        parent::setUp();

        $this->participant = new Participant();
    }

    /** @test */
    public function it_belongs_to_many_classes()
    {
        $this->assertInstanceOf(BelongsToMany::class, $this->participant->classes());
    }
}
