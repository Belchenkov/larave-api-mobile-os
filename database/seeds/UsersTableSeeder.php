<?php

use App\Models\UserJwtToken;
use App\Models\UserToken;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function ($user) {
            $user->userToken()->save(factory(UserToken::class)->make());
            $user->userJwtToken()->save(factory(UserJwtToken::class)->make());
            return;
        });
    }
}
