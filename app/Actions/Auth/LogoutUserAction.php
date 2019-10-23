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
    public function execute(User $user, $id_device = null)
    {
        if ($id_device) {
            $user->devices()->where('device_id', $id_device)->delete();
        }

        $user->removeSession(request()->bearerToken());
        return $this;
    }
}
