<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\EmailLog::class, function (Faker $faker) {
    return [
        'subject' => $faker->sentence(),
        'email_template_id' => function () {
            return factory(App\Entities\EmailTemplate::class)->create()->id;
        }
    ];
});
