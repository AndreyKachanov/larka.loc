<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'       => $faker->realText(rand(30, 50)),
        'description' => $faker->realText(rand(3000, 6000)),
    ];
});
