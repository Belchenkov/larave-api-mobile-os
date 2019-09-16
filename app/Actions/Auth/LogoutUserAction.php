<?php

namespace App\Actions\Auth;


use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\User;
use App\Models\UserJwtToken;

/**
 * Class LogoutUserAction
 * @package App\Actions\Auth
 * Logout User
 */
class LogoutUserAction extends BaseAction
{
    /**
     * @var UserJwtToken
     */
    private $userJwtToken = null;

    public function execute(User $user)
    {
        if ($userJwtToken = UserJwtToken::where('user_id', $user->id)->first()) {
            $this->userJwtToken = $userJwtToken;

            if ($this->userJwtToken->delete()) {
                $this->setActionResult(true);
            } else {
                throw new ApiException(500, 'Error delete JWT Token');
            }
        } else {
            throw new ApiException(422, 'User not found');
        }

        return $this;
    }
}
