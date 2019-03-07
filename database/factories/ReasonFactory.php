<?php

use Faker\Generator as Faker;

$factory->define(App\Reason::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->sentence(),
        'expires_at' => $faker->dateTime()
    ];
});
