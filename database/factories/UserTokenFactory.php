<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserPinCode;
use Faker\Generator as Faker;

$factory->define(UserPinCode::class, function (Faker $faker) {
    return [
        'pin_code' => $faker->numberBetween($min = 1000, $max = 9000)
    ];
});
