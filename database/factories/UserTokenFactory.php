<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserToken;
use Faker\Generator as Faker;

$factory->define(UserToken::class, function (Faker $faker) {
    return [
        'pin_code' => $faker->numberBetween($min = 1000, $max = 9000)
    ];
});
