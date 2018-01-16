<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $username = $faker->firstNameMale;
    $rolid = $faker->biasedNumberBetween($min = 1, $max = 3);
    $email = $faker->unique()->safeEmail;

    return [
        'firstname' => $faker->firstNameMale,
        'lastname'  => $faker->lastName,
        'username'=> $username,
        'email' => $email,
        'imageurl' => $faker->imageUrl($width = 800, $height = 600, 'cats'),
        'rol_id'=> $rolid,
        'remember_token' => str_random(10),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        
    ];
});
