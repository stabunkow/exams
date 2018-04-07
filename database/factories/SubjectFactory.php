<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Subject::class, function (Faker $faker) {
    $now = now()->toDateTimeString();
    return [
        'name' => $faker->streetName,
        'description' => $faker->text,
        'created_at' => $now,
        'updated_at' => $now
    ];
});
