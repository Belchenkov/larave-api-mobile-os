<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserJwtToken;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(UserJwtToken::class, function (Faker $faker) {
    return [
        'access_token' => \str_random(60),
        'refresh_token' => str_random(60),
        'access_expire_at' => Carbon::now()->addHours(6)->format('Y-m-d H:i:s'),
        'refresh_expire_at' => Carbon::now()->addDays(3)->format('Y-m-d H:i:s')
    ];
});
