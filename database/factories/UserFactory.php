<?php


use App\Entity\User\User;
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
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker $faker) {
    return [
        'name'                      => $faker->name,
        'email'                     => $faker->unique()->safeEmail,
        'email_verified_at'         => null,
        'role_id'                   => 3, // User
        'password'                  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'phone'                     => '38099' . mt_rand(1111111, 9999999),
        'phone_auth'                => false,
        'phone_verified'            => false,
        'phone_verify_token'        => null,
        'phone_verify_token_expire' => null,
        'status'                    => User::STATUS_WAIT,
        'remember_token'            => null
    ];
});
