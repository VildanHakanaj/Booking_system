<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'brand' => $faker->word,
        'desc' => $faker->sentence,
        'serial_number' => $faker->numerify(),
        'status' => 1,
        'notes' => $faker->sentence,
    ];
});
