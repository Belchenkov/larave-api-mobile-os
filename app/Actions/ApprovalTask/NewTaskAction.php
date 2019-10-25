<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Actions\ApprovalTask;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\EventHandle;
use App\Models\Transit\DoTask;
use App\Notifications\ApprovalTask\NewTaskNotification;

class NewTaskAction extends BaseAction
{
    /**
     * @param DoTask $task
     * @return $this
     * Execute new task
     */
    public function execute(DoTask $task)
    {
        if (!$task->user)
            throw new ApiException(422, 'Task user not found.');

        // Send push, email, etc
        $task->user->notify(new NewTaskNotification($task));

        $task->handleEvent()->create([
            'handle_type' => EventHandle::HANDLE_TYPE_DOTASK
        ]);

        return $this;
    }
}
