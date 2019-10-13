<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Models\EventHandle;
use App\Models\User;
use App\Notifications\Schedule\IsLateUserNotification;

class LateUserAction extends BaseAction
{
    public function execute(User $user)
    {
        // Send push, email, etc
        $user->notify(new IsLateUserNotification());

        $user->handleLate()->create([
            'handle_type' => EventHandle::HANDLE_TYPE_LATE
        ]);

        return $this;
    }
}
