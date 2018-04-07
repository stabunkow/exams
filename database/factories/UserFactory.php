<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\User::class, function (Faker $faker) {
    static $avatar = 'http://lorempixel.com/200/200/animals';
    $now = now()->toDateTimeString();
    return [
        'name' => $faker->name,
        'avatar' => $avatar."?".rand(1, 10000),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'sex' => rand(1, 2),
        'wallet' => 100,
        'remember_token' => str_random(10),
        'created_at' => $now,
        'updated_at' => $now
    ];
});
