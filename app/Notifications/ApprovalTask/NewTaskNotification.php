<?php

namespace App\Notifications\ApprovalTask;

use App\Models\Transit\DoTask;
use App\Services\Firebase\FirebaseChannel;
use App\Services\Firebase\FirebaseMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewTaskNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $taskName;

    /**
     * Create a new notification instance.
     *
     * @param DoTask $task
     */
    public function __construct(DoTask $task)
    {
        $this->task_name = $task->name_task_1C;
        $this->task_id = $task->id_task_1C;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FirebaseChannel::class];
    }

    /**
     * @param $notifiable
     * @return FirebaseMessage
     */
    public function toFirebase($notifiable)
    {
        return new FirebaseMessage(
            'ГК Основа: Новая задача в кабинете согласования',
            $this->task_name,
            'push-channel',
            [
                'screen' => 'task-approval'
            ],
            $notifiable->devices->pluck('device_id')->toArray()
        );
    }
}
