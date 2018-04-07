<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ExerciseBook::class, function (Faker $faker) {
    $now = now()->toDateTimeString();
    return [
        'title' => $faker->city,
        'description' => $faker->sentence,
        'price' => rand(1, 100),
        'created_at' => $now,
        'updated_at' => $now
    ];
});
