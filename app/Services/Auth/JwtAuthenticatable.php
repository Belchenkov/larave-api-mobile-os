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

    /**
     * @param $session_id
     */
    public function removeSessionById($session_id)
    {
        $this->jwtToken()->where('id', $session_id)->delete();
    }

    /**
     * @param $access_token
     * Remove session by access_token
     */
    public function removeSession($access_token)
    {
        $this->jwtToken()->where('access_token', $access_token)->delete();
    }

    /**
     * Remove all sessions
     */
    public function removeAllSession()
    {
        $this->jwtToken()->delete();
    }

    /**
     * @param $access_token
     * Remove all sessions except current
     */
    public function removeOtherSession($access_token)
    {
        $this->jwtToken()->where('access_token', '<>', $access_token)->delete();
    }

    public function getSessionList()
    {
        $current = $this->jwtToken()->where('access_token', request()->bearerToken())->first();
        $sessions = $this->jwtToken()->orderBy('created_at', 'DESC')->get(
            [
                'id',
                'user_agent',
                'ip_address',
                'access_expire_at',
                'refresh_expire_at',
                'created_at',
                'updated_at'
            ]
        );

        return $sessions->map(function ($session) use ($current) {
            $session->setAttribute('current', false);
            if ($current && $session->id == $current->id)
                $session->setAttribute('current', true);

            return $session;
        });
    }

    /**
     * @return mixed
     * Generate access/refresh tokens
     */
    public function generateJwt()
    {
        do {
            $this->access_token = str_random(60);
        } while (UserJwtToken::where('access_token', $this->access_token)->exists());

        do {
            $this->refresh_token = str_random(60);
        } while (UserJwtToken::where('refresh_token', $this->refresh_token)->exists());

        // ToDo - Add multiple auth
        return $this->jwtToken()->create(
            [
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
                'access_expire_at' => Carbon::now()->addHours(6)->format('Y-m-d H:i:s'),
                'refresh_expire_at' => Carbon::now()->addDays(14)->format('Y-m-d H:i:s'),
                'ip_address' => request()->getClientIp(),
                'user_agent' => request()->header('User-Agent')
            ]
        );

    }

    public function updateJwt(UserJwtToken $token)
    {
        do {
            $this->access_token = str_random(60);
        } while (UserJwtToken::where('access_token', $this->access_token)->exists());

        do {
            $this->refresh_token = str_random(60);
        } while (UserJwtToken::where('refresh_token', $this->refresh_token)->exists());

        $token->update(
            [
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
                'access_expire_at' => Carbon::now()->addHours(6)->format('Y-m-d H:i:s'),
                'refresh_expire_at' => Carbon::now()->addDays(14)->format('Y-m-d H:i:s'),
            ]
        );

        return $token;
    }

}
