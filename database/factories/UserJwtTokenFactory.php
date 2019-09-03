<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\UserJwtToken;
use Faker\Generator as Faker;

$factory->define(UserJwtToken::class, function (Faker $faker) {
    return [
        'access_token' => \Str::random(30),
        'refresh_token' => \Str::random(30),
        'expires_in' => 3600
    ];
});
