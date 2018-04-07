<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Headline::class, function (Faker $faker) {
    static $image = 'http://lorempixel.com/800/450/';
    $now = now()->toDateTimeString();

    return [
        'title' => $faker->slug,
        'image' => $image."?".rand(1, 10000),
        'content' => $faker->text,
        'is_enabled' => true,
        'published_at' => $now,
        'created_at' => $now,
        'updated_at' => $now
    ];
});
