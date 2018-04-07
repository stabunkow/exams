<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Question::class, function (Faker $faker) {
    $now = now()->toDateTimeString();
    return [
        'content' => $faker->text,
        'analyse' => $faker->text,
        'created_at' => $now,
        'updated_at' => $now
    ];
});
