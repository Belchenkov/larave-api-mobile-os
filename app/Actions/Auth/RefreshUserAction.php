<?php
/**
 * Created by black40x@yandex.ru
 * Date: 05/09/2019
 */

namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiAuthorizationException;
use App\Models\User;
use App\Models\UserJwtToken;
use Carbon\Carbon;

class RefreshUserAction extends BaseAction
{
    /**
     * @var User
     */
    private $user = null;

    public function execute($refresh_token)
    {
        if ($token = UserJwtToken::where('refresh_token', $refresh_token)
            ->where('refresh_expire_at', '>', Carbon::now())->first()) {
            $this->user = $token->user;
            $this->user->generateJwt();
            $this->setActionResult($this->user->jwtToken);
        } else
            throw new ApiAuthorizationException();

        return $this;
    }

}
