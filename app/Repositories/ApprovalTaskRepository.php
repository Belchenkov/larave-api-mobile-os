<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Repositories;


use App\Models\Transit\DoTask;
use App\Models\User;
use Carbon\Carbon;

class ApprovalTaskRepository
{

    public function getUserTasks(User $user, bool $archive = false)
    {
        if ($archive) {
            $tasks = $user->approvalExecutorTasks()->where('task_status', '<>', DoTask::TASK_CAN_EDIT);
        } else {
            $tasks = $user->approvalExecutorTasks()->where('task_status', '=', DoTask::TASK_CAN_EDIT);
        }

        $tasks->with(['initiator.employee']);

        // ToDo - only valid columns ?
        return $tasks->orderBy('Date', 'DESC')->get();
    }

    public function getTask($task_id) : ?DoTask
    {
        return DoTask::with([
            'initiator.employee',
            'relatedTasks' => function ($query) use ($task_id) {
                $query->where('id_task_1C', '<>', $task_id)->whereNotNull('id_process_1C_parent');
            },
            'relatedTasks.executor.employee'
        ])->first();
    }

    public function getUserTask(User $user, $task_id) : ?DoTask
    {
        return $user
            ->approvalExecutorTasks()
            ->with([
                'initiator.employee',
                'relatedTasks' => function ($query) use ($task_id) {
                    $query->where('id_task_1C', '<>', $task_id)->whereNotNull('id_process_1C_parent');
                }
            ])
            ->where('id_task_1C', $task_id)
            ->first();
    }

    public function updateUserTask(DoTask $task, $status, $comment) : bool
    {
        if ($task->task_status != DoTask::TASK_CAN_EDIT)
            return false; // ToDo - maybe exception

        $task->update([
            'task_comment_execution' => $comment,
            'task_status' => $status,
            'dt' => Carbon::now()
            // ToDo - name_source / date_source / dt / accept_date ????
        ]);

        return true;
    }

}
