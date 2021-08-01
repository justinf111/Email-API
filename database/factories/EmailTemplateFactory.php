<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\EmailTemplate::class, function (Faker $faker) {
    return [
        'content' => "<p>To {username},</p>"."<p>".$faker->paragraph."</p>"
    ];
});
