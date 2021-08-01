<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Recipient::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->email
    ];
});
