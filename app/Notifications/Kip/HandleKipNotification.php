<?php

namespace App\Notifications\Kip;

use App\Services\Firebase\FirebaseChannel;
use App\Services\Firebase\FirebaseMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleKipNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $kip;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($kip)
    {
        $this->kip = $kip;
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
            $this->kip['title'],
            $this->kip['message'],
            'osnova',
            [
                'screen' => 'OSNOVA_APPROVING_TASK_INFO',
                'id' => $this->kip['id']
            ],
            $notifiable->devices->pluck('device_id')->toArray()
        );
    }
}
