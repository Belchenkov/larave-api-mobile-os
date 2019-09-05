<?php
/**
 * Created by black40x@yandex.ru
 * Date: 05/09/2019
 */

namespace App\Services\Auth;


use App\Models\UserJwtToken;
use Carbon\Carbon;

trait JwtAuthenticatable
{

    private $access_token = null;
    private $refresh_token = null;

    public function generateJwt()
    {
        do {
            $this->access_token = str_random(60);
        } while (UserJwtToken::where('access_token', $this->access_token)->exists());

        do {
            $this->refresh_token = str_random(60);
        } while (UserJwtToken::where('refresh_token', $this->refresh_token)->exists());

        $this->jwtToken()->updateOrCreate(
            [
                'user_id' => $this->id
            ],
            [
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
                'access_expire_at' => Carbon::now()->addHours(6)->format('Y-m-d H:i:s'),
                'refresh_expire_at' => Carbon::now()->addDays(3)->format('Y-m-d H:i:s'),
            ]
        );

    }

}
