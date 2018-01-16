<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        
        'name' => $faker->firstNameFemale(),
        'email' => $faker->safeEmail(),
        'body'  => $faker->text(150),
        'post_id' => $faker->randomDigitNotNull()

    ];
});
