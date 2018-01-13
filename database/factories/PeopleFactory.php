<?php

use Faker\Generator as Faker;

$factory->define(App\People::class, function (Faker $faker) {
    return [
        
        'cui'  => $faker->randomNumber($nbDigits = 5),
        'firstname'  => $faker->firstName('male'),
        'lastname'  => $faker->lastName,
        'address'  => $faker->address,
        'imageurl' => $faker->imageUrl($width = 800, $height = 600, 'cats'),


    ];
});
