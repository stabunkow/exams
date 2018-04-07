<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Section::class, function (Faker $faker) {
    $now = now()->toDateTimeString();

    return [
        'name' => $faker->streetAddress,
        'description' => $faker->text,
        'created_at' => $now,
        'updated_at' => $now
    ];
});
