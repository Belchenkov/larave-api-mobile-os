<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Repositories;


use App\Models\EventHandle;
use App\Models\Transit\DoTask;
use App\Structure\ApprovalTask\ApprovalTaskActions;
use App\Structure\User\UserInterface;
use Carbon\Carbon;

class ApprovalTaskRepository
{

    public function getUserTasks(UserInterface $user, bool $archive = false)
    {
        if ($archive) {
            $tasks = $user->approvalTasksExecutor()->where('task_status', '<>', ApprovalTaskActions::TASK_CAN_EDIT);
        } else {
            $tasks = $user->approvalTasksExecutor()->where('task_status', '=', ApprovalTaskActions::TASK_CAN_EDIT);
        }

        $tasks->with(['initiator']);

        // ToDo - only valid columns ?
        return $tasks->orderBy('Date', 'DESC');
    }

    public function getTask($task_id) : ?DoTask
    {
        return DoTask::with([
            'initiator.employee',
            'relatedTasks.executor.employee',
            'relatedTasks' => function ($query) use ($task_id) {
                $query->where('id_task_1C', '<>', $task_id)->whereNotNull('id_process_1C_parent');
            },
        ])->first();
    }

    public function getUserTask(UserInterface $user, $task_id) : ?DoTask
    {
        return $user
            ->approvalTasksExecutor()
            ->with([
                'initiator.employee',
                'relatedTasks.executor.employee',
                'relatedTasks' => function ($query) use ($task_id) {
                    $query->where('id_task_1C', '<>', $task_id)->whereNotNull('id_process_1C_parent');
                }
            ])
            ->where('id_task_1C', $task_id)
            ->first();
    }

    public function updateUserTask(DoTask $task, $status, $comment) : bool
    {
        if ($task->task_status != ApprovalTaskActions::TASK_CAN_EDIT)
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
        $unUsedTasks = DoTask::where('task_status', '=', 0)->with([
            'handleTask' => function($query) {
                $query->where('handle_type', EventHandle::HANDLE_TYPE_DOTASK);
            },
            'user'
        ])->get();
        foreach ($unUsedTasks as $task) {
            if (!$task->handleTask && $task->user) {
                $tasks->push($task);
            }
        }

        return $tasks;
    }

}
