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

/**
 * Class LateUserAction
 * @package App\Actions\Users
 * Execute Action if User be late
 */
class LateUserAction extends BaseAction
{
    /**
     * @param User $user
     * @return $this
     */
    public function execute(User $user)
    {
        // Send push, email, etc
        $user->notify(new IsLateUserNotification($user['stat']));

        $user->handleEvent()->create([
            'handle_type' => EventHandle::HANDLE_TYPE_VISITOR
        ]);

        return $this;
    }
}
