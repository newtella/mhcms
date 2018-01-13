<?php

use Faker\Generator as Faker;

$factory->define(App\Rol::class, function (Faker $faker) {
    $title = $faker->sentence(4);
    return [
        'name'  => $title,
    ];
});
