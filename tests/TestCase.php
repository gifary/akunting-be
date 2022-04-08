<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;
use Tests\Traits\InteractsWithResponseMacros;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, InteractsWithResponseMacros;

    protected $user;

    /**
     * Setup the test environment
     *
     * @return  void
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->bootResponseMacros();

        // $this->withoutExceptionHandling();
    }

    public function signIn(User $user = null)
    {
        $this->user = $user ?? factory(User::class)->create();

        $this->actingAs($this->user);

        return $this->user;
    }

    public function apiSignIn(User $user = null)
    {
        $this->user = $user ?? factory(User::class)->create();

        Passport::actingAs($this->user);

        return $this->user;
    }
}
