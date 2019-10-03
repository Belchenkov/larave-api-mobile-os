<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\ApprovalTask\UpdateTaskAction;
use App\Actions\ApprovalTask\CancelTaskAction;
use App\Exceptions\Api\ApiException;
use App\Http\Requests\Api\v1\ApprovalTask\UpdateTaskRequest;
use App\Http\Resources\Api\v1\ApprovalTask\ApprovalTask;
use App\Http\Resources\Api\v1\ApprovalTask\ApprovalTasks;
use App\Models\User;
use App\Repositories\ApprovalTaskRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApprovalTaskController extends Controller
{
    private $approvalTaskRepository;

    public function __construct()
    {
        $this->approvalTaskRepository = new ApprovalTaskRepository();
    }

    public function getTasks(Request $request)
    {
        return ApprovalTasks::collection(
            $this->approvalTaskRepository->getUserTasks(
                Auth::user(),
                (bool) $request->get('archive', false)
            )->get()
        );
    }

    public function getTask(Request $request, $task_id)
    {
        if (!$task = $this->approvalTaskRepository->getUserTask(User::find(10002), $task_id)) {
            throw new ApiException(404, 'User task not found.');
        }

        return new ApprovalTask($task);
    }

    public function updateTask(UpdateTaskRequest $request, $task_id, UpdateTaskAction $action)
    {
        if (!$task = $this->approvalTaskRepository->getUserTask(Auth::user(), $task_id)) {
            throw new ApiException(404, 'User task not found or user not owner.');
        }

        return $action->execute(
            $task,
            $request->get('status'), $request->get('comment')
        )->apiSuccess();
    }

}
