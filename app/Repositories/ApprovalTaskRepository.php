<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Repositories;


use App\Actions\ApprovalTask\NewTaskAction;
use App\Models\DoTaskHandle;
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
        return $tasks->orderBy('Date', 'DESC');
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
            return false;

        $task->setPrimaryKey()->update([
            'task_comment_execution' => $comment,
            'task_status' => $status,
            'dt_update_source' => Carbon::now(),
            'fact_date_finish' => Carbon::now(),
            'Name_source' => 'mobapp'
        ]);

        return true;
    }

    public function handleNewTasks()
    {
        $tasks = collect();
        $unUsedTasks = DoTask::where('task_status', '=', 0)->with(['handleTask', 'user'])->get();

        foreach ($unUsedTasks as $task) {
            if (!$task->handleTask && $task->user) {
                $tasks->push($task);
            }
        }

        return $tasks;
    }

}
