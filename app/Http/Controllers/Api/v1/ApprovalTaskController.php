<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\ApprovalTask\UpdateTaskAction;
use App\Actions\ApprovalTask\CancelTaskAction;
use App\Exceptions\Api\ApiException;
use App\Http\Requests\Api\v1\ApprovalTask\UpdateTaskRequest;
use App\Http\Resources\Api\v1\ApprovalTask\ApprovalTask;
use App\Http\Resources\Api\v1\ApprovalTask\ApprovalTasks;
use App\Repositories\ApprovalTaskRepository;
use GuzzleHttp\Client;
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
                Auth::user()->portalUser,
                (bool) $request->get('archive', false)
            )->get()
        );
    }

    public function getTask(Request $request, $task_id)
    {
        if (!$task = $this->approvalTaskRepository->getUserTask(Auth::user()->portalUser, $task_id)) {
            throw new ApiException(404, 'User task not found.');
        }

        return new ApprovalTask($task);
    }

    public function updateTask(UpdateTaskRequest $request, $task_id, UpdateTaskAction $action)
    {
        if (!$task = $this->approvalTaskRepository->getUserTask(Auth::user()->portalUser, $task_id)) {
            throw new ApiException(404, 'User task not found or user not owner.');
        }

        return $action->execute(
            $task,
            $request->get('status'), $request->get('comment')
        )->apiSuccess();
    }

    public function downloadDocument(Request $request, $doc_id)
    {
        try {
            $client = new Client([
                'base_uri' => config('workflow.doc_download'),
                'timeout' => 10.0,
                'auth' => [
                    config('workflow.doc_download_user'),
                    config('workflow.doc_download_pass')
                ]
            ]);

            $response = $client->get('?id=' . $doc_id);

            return response($response->getBody()->getContents(), 200, $response->getHeaders());
        } catch (\Exception $exception) {
            throw new ApiException(404, 'File not found.');
        }
    }

}
