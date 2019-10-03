<?php

namespace App\Jobs;

use App\Models\NewTaskPush;
use App\Models\Transit\DoTask;
use App\Models\User;
use App\Notifications\Push\SendPush;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNewTaskPush implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const NEW_PUSH = 0;
    const COMPLETED_PUSH = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $newTasks = DoTask::where('task_status', '=', 0)->get();
        $oldTasksIds = NewTaskPush::all()->pluck('task_id')->toArray();

        foreach ($newTasks as $newTask) {
            if (!in_array($newTask->id_task_1C, $oldTasksIds)) {
                NewTaskPush::create([
                    'task_id' => $newTask->id_task_1C,
                    'status' => self::NEW_PUSH
                ]);
            }
        }

        $pushTasks = NewTaskPush::where('status', self::NEW_PUSH)->get();

        foreach ($pushTasks as $pushTask) {
            $user = User::where('id_person', $pushTask->doTask->executor->id_phperson)->first(); // через  $pushTask->doTask->executor->user - выбивает ошибку, пока не могу понять

            if ($user) {
                $user->notify(new SendPush(
                    'ГК Основа: Новая задача в кабинете согласования',
                    $pushTask->doTask->name_task_1C,
                    ''
                ));
                $pushTask->update(['status' => self::COMPLETED_PUSH]);
            }
        }

        SendNewTaskPush::dispatch()->delay(now()->addMinutes(config('workflow.time_update_new_approval_tasks')));
    }
}
