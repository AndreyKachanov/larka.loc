<?php
use App\Entity\Post;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'       => $faker->realText(rand(30, 50)),
        'description' => $faker->realText(rand(3000, 6000)),
    ];
});
