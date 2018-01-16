<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->unique()->sentence(5);
    $bodyexcerpt = $faker->text($maxNbChars = 200);
    $body = $faker->text;
    $rndminteger = $faker->randomDigitNotNull();
    $image = $faker->imageUrl($width = 1024, $height = 768, 'cats');
    return [
        'name'  =>$title,
        'slug'  => str_slug($title),
        'body'  => $body,
        'excerpt' => $bodyexcerpt,  
        'category_id' => $rndminteger,
        'user_id' => $rndminteger,
        'imageurl' =>$image
    ];
});
