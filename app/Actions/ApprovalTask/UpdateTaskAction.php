<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Actions\ApprovalTask;


use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\Transit\DoTask;
use App\Repositories\ApprovalTaskRepository;
use Carbon\Carbon;

class UpdateTaskAction extends BaseAction
{

    private $approvalTaskRepository;

    public function __construct()
    {
        $this->approvalTaskRepository = new ApprovalTaskRepository();
    }

    public function execute(DoTask $task, $status, $comment)
    {
        if ($task->task_status != DoTask::TASK_CAN_EDIT)
            throw new ApiException(422, 'User task cant be updated');

        // ToDo - validate by task type!!!! IMPORTANT type_descriptions
        if (!in_array($status, [DoTask::TASK_ACCEPT, DoTask::TASK_CANCEL, DoTask::TASK_APPLY, DoTask::TASK_APPLY_WITH_COMMENT]))
            throw new ApiException(422, 'Invalid task status');

        $this->approvalTaskRepository->updateUserTask($task, $status, $comment);

        // ToDo - send push or other?

        return $this;
    }

}
