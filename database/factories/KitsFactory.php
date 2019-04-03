<?php

use Faker\Generator as Faker;

$factory->define(App\Kit::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'booking_window' => '3',
        'back_to_back' => '0',
        'status' => '1',
    ];
});
