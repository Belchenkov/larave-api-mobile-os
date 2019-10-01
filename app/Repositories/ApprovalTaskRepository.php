<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Repositories;


use App\Models\Transit\DoTask;
use App\Models\User;

class ApprovalTaskRepository
{

    public function getUserTasks(User $user, bool $archive = false)
    {
        if ($archive) {
            $tasks = $user->approvalExecutorTasks()->where('task_status', '<>', 0)->get();
        } else {
            $tasks = $user->approvalExecutorTasks()->where('task_status', '=', 0)->get();
        }

        // ToDo with relations

        return $tasks;
    }

    public function updateUserTask(DoTask $task, $status, $comment)
    {
        // ToDo - ?
    }

}
