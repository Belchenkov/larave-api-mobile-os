<?php

namespace App\Actions\Auth;


use App\Actions\BaseAction;
use App\Models\User;

/**
 * Class LogoutUserAction
 * @package App\Actions\Auth
 * Logout User
 */
class LogoutUserAction extends BaseAction
{
    /**
     * @param User $user
     * @return $this
     * Logout User
     */
    public function execute(User $user)
    {
        $user->removeSession(request()->bearerToken());
        return $this;
    }
}
