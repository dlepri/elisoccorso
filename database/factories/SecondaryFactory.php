<?php

use App\Secondary;
use Faker\Generator as Faker;

$factory->define(Secondary::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->realText(100),
        'image' => null,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'active' => rand(0, 1),
        'created_at' => $faker->dateTimeThisDecade
    ];
});
