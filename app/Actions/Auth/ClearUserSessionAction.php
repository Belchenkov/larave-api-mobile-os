<?php

namespace App\Actions\Auth;


use App\Actions\BaseAction;
use App\Models\User;

/**
 * Class LogoutUserAction
 * @package App\Actions\Auth
 * Logout User
 */
class ClearUserSessionAction extends BaseAction
{
    /**
     * @param User $user
     * @return $this
     * Clear User Session
     */
    public function execute(User $user)
    {
        $user->removeOtherSession(request()->bearerToken());

        return $this;
    }
}
