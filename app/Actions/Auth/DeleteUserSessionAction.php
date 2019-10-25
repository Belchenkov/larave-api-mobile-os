<?php

namespace App\Actions\Auth;


use App\Actions\BaseAction;
use App\Models\User;

/**
 * Class LogoutUserAction
 * @package App\Actions\Auth
 * Logout User
 */
class DeleteUserSessionAction extends BaseAction
{
    /**
     * @param User $user
     * @param $session_id
     * @return $this
     */
    public function execute(User $user, $session_id)
    {
        $user->removeSessionById($session_id);

        return $this;
    }
}
