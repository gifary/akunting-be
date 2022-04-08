<?php
namespace Database\Factories;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

class ParticipantFactory extends Factory {
    protected $model = Participant::class;

    public function definition()
    {
        // TODO: Implement definition() method.
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'nip' => $this->faker->name,
            'phone_country_code' => '62',
            'phone' => $this->faker->phoneNumber,
            'birth_date' => Carbon::now()->subYears(10)->toDateString(),
            'unique_code' => rand(0,1000),
            'gender' => 'ikhwan',
            'status' => 'active',
            'billing_cycle' => Carbon::now()->day,
        ];
    }
}

