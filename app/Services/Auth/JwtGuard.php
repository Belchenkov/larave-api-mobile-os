<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Services\Auth;


use App\Exceptions\Api\ApiAuthorizationException;
use App\Models\UserJwtToken;
use Carbon\Carbon;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;

class JwtGuard implements Guard
{
    use GuardHelpers;

    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        $user = null;

        if ($token = UserJwtToken::where('access_token', request()->bearerToken())
            ->where('access_expire_at', '>', Carbon::now())->first()) {
            $user = $token->user;
        } else {
            throw new ApiAuthorizationException();
        }

        return $this->user = $user;
    }

    /**
     * Validate a user's credentials.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
    }
}
