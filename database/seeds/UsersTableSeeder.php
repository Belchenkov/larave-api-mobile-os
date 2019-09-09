<?php

use App\Models\User\UserJwtToken;
use App\Models\User\UserPinCode;
use App\Models\User\User;
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
            $user->pinCode()->save(factory(UserPinCode::class)->make());
            $user->jwtToken()->save(factory(UserJwtToken::class)->make());
            return;
        });
    }
}
