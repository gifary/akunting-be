<?php


use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'name' => $faker->name,
        'password' => Hash::make('secret'),
        'email_verified_at'        => Carbon::now(),
    ];
});
