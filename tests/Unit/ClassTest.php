<?php


namespace Tests\Unit;


use App\Models\Classes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class ClassTest extends TestCase
{
    private $class;

    protected function setUp() : void
    {
        parent::setUp();

        $this->class = new Classes();
    }

    /** @test */
    public function it_belongs_to_many_participants()
    {
        $this->assertInstanceOf(BelongsToMany::class, $this->class->participants());
    }

}
