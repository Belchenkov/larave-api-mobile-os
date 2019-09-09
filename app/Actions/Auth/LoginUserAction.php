<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Models\User\User;

class LoginUserAction extends BaseAction
{
    /**
     * @var User
     */
    private $user = null;

    public function execute(LoginRequest $request)
    {
        if ($user = User::where('ad_login', $request->login)->first()) {
            // ToDo add lifetime
            if ($user->pinCode && $user->pinCode->pin_code == $request->pin_code) {
                $this->user = $user;
                $this->user->generateJwt();
                $this->setActionResult($this->user->jwtToken);
            } else
                throw new ApiException(422, 'Invalid pin code');
        } else {
            throw new ApiException(422, 'User not found');
        }

        return $this;
    }
}
