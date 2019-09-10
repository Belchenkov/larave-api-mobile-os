<?php
/**
 * Created by black40x@yandex.ru
 * Date: 05/09/2019
 */

namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiAuthorizationException;
use App\Http\Requests\Api\v1\Auth\RefreshRequest;
use App\Models\User;
use App\Models\UserJwtToken;
use Carbon\Carbon;

class RefreshUserAction extends BaseAction
{
    /**
     * @var User
     */
    private $user = null;

    public function execute(RefreshRequest $request)
    {
        if ($token = UserJwtToken::where('refresh_token', $request->refresh_token)
            ->where('refresh_expire_at', '>', Carbon::now())->first()) {
            $this->user = $token->user;
            $this->user->generateJwt();
            $this->setActionResult($this->user->jwtToken);
        } else
            throw new ApiAuthorizationException();

        return $this;
    }

}
