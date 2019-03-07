<?php

use Faker\Generator as Faker;

$factory->define(App\ReasonToBook::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'reason_id' => factory(App\Reason::class),
        'active' => 1
    ];
});
