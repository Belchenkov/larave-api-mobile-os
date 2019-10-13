<?php

namespace App\Jobs\Schedule;

use App\Actions\Users\LateUserAction;
use App\Models\EventHandle;
use App\Repositories\User\StatisticVisitRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class HandleIsLateUser implements ShouldQueue
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
        $this->repository = new StatisticVisitRepository();
        $this->action = new LateUserAction();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        EventHandle::where('handle_type', EventHandle::HANDLE_TYPE_LATE)
            ->whereDate('created_at', '<', Carbon::now()->format('Y-m-d'))
            ->delete();

        $laters = $this->repository->handleLateUsers();
        foreach ($laters as $user) {
            $this->action->execute($user);
        }

        HandleIsLateUser::dispatch()->delay(now()->addMinutes(config('workflow.time_update_late_users')));
    }
}
