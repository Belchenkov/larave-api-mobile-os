<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\ApprovalTask\AcceptTaskAction;
use App\Actions\ApprovalTask\CancelTaskAction;
use App\Exceptions\Api\ApiException;
use App\Http\Resources\Api\v1\ApprovalTask\ApprovalTask;
use App\Http\Resources\Api\v1\ApprovalTask\ApprovalTasks;
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
        if (!$task = $this->approvalTaskRepository->getUserTask(Auth::user(), $task_id)) {
            throw new ApiException(404, 'User task not found.');
        }

        return new ApprovalTask($task);
    }

    public function applyTask(Request $request, $task_id, AcceptTaskAction $action)
    {
        //
    }

    public function cancelTask(Request $request, $task_id, CancelTaskAction $action)
    {
        //
    }

}
