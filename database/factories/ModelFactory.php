<?php

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | Here you may define all of your model factories. Model factories give
  | you a convenient way to create models for testing and seeding your
  | database. Just tell the factory how a default model should look.
  |
 */

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->username,
        'email' => $faker->safeEmail,
        'password' => password_hash('abdou', PASSWORD_BCRYPT),
        'remember_token' => str_random(10),
        'sec_id' => rand(1, 2)
    ];
});

$factory->defineAs(App\User::class, 'admin', function ($faker) use ($factory) {
    $user = $factory->raw(App\User::class);
    return array_merge($user, ['superAdmin' => 1]);
});

$factory->define(App\Info::class, function (Faker\Generator $faker) {
    return [
        'title' => 'Mr',
        'fullname' => $faker->name,
        'job' => $faker->company,
        'birthdate' => $faker->dateTimeThisCentury,
    ];
});
