<?php
namespace Database\Factories;

use App\Models\Classes;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassesFactory extends Factory {
    protected $model = Classes::class;

    public function definition()
    {
        // TODO: Implement definition() method.
        return [
            'name' => $this->faker->name,
            'period' => "2022",
            'description' => $this->faker->text(128),
            'price' => 100000,
        ];
    }
}
