<?php

namespace App\Notifications\Schedule;

use App\Services\Firebase\FirebaseChannel;
use App\Services\Firebase\FirebaseMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IsLateUserNotification extends Notification
{
    use Queueable;

    private $stat;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($stat)
    {
        $this->stat = $stat;
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
        if ($notifiable->devices->count() == 0)
            return null;

        return new FirebaseMessage(
            'ГК Основа',
            'Вы опоздали на работу и пришли в ' . $this->stat['enter_time']->format('H:i:s'),
            'push-channel',
            [
                'screen' => 'statistic-visit'
            ],
            $notifiable->devices->pluck('device_id')->toArray()
        );
    }
}
