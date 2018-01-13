<?php

use Faker\Generator as Faker;

$factory->define(App\People::class, function (Faker $faker) {
    return [
        
        'cui'  => $faker->randomNumber(15),
        'firstname'  => $faker->firstName('male'),
        'lastname'  => $faker->lastName,
        'address'  => $faker->address,
        'imageurl' => $faker->image($width, $height, 'cats'),


    ];
});
