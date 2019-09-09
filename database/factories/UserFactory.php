<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'ad_login' => $faker->lastName,
        'tab_no' => $faker->uuid,
        'id_person' => $faker->uuid
    ];
});
