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
    $peopleid = $faker->biasedNumberBetween($min = 1, $max = 20);
    $rolid = $faker->biasedNumberBetween($min = 1, $max = 3);
    $email = $faker->unique()->safeEmail;

    return [
        'name' => $faker->name,
        'username'=> $faker->$username,
        'email' => $faker->$email,
        'people_id'=> $faker->$peopleid,
        'rol_id'=> $faker->$rolid,
        'remember_token' => str_random(10),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        
    ];
});
