<?php

namespace App\Jobs\Schedule;

use App\Actions\Users\InTimeUserAction;
use App\Actions\Users\LateUserAction;
use App\Models\EventHandle;
use App\Repositories\User\StatisticVisitRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class HandleIsVisitUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $repository;
    private $actionLate;
    private $actionInTime;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = new StatisticVisitRepository();
        $this->actionLate = new LateUserAction();
        $this->actionInTime = new InTimeUserAction();
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

        EventHandle::where('handle_type', EventHandle::HANDLE_TYPE_INTIME)
            ->whereDate('created_at', '<', Carbon::now()->format('Y-m-d'))
            ->delete();

        $visitors = $this->repository->handleEnterUsers();

        foreach ($visitors as $user) {
            if ($user['stat']['is_late']) {
                $this->actionLate->execute($user);
            } else {
                $this->actionInTime->execute($user);
            }
        }

        HandleIsVisitUser::dispatch()->delay(now()->addMinutes(config('workflow.time_update_late_users')));
    }
}
