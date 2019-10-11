<?php

namespace App\Jobs;

use App\Actions\ApprovalTask\NewTaskAction;
use App\Repositories\ApprovalTaskRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class HandleNewTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $repository;
    private $action;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = new ApprovalTaskRepository();
        $this->action = new NewTaskAction();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $newTasks = $this->repository->handleNewTasks();
        foreach ($newTasks as $task) {
            $this->action->execute($task);
        }

        HandleNewTask::dispatch()->delay(now()->addMinutes(config('workflow.time_update_new_approval_tasks')));
    }
}
