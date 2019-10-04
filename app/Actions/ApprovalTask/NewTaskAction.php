<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Actions\ApprovalTask;


use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\DoTaskHandle;
use App\Models\Transit\DoTask;
use App\Notifications\Push\SendPush;

class NewTaskAction extends BaseAction
{
    public function execute(DoTask $task)
    {
        if (!$task->user)
            throw new ApiException(422, 'Task user not found.');

        // Send push, email, etc
        $task->user->notify(
            new SendPush(
                'ГК Основа: Новая задача в кабинете согласования',
                $task->name_task_1C,
                ''
            )
        );

        $task->handleTask()->create();

        return $this;
    }
}
