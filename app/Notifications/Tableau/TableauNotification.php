<?php

namespace App\Notifications\Tableau;

use App\Services\Firebase\FirebaseChannel;
use App\Services\Firebase\FirebaseMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class TableauNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $title;

    /**
     * Create a new notification instance.
     *
     * @param string $title
     */
    public function __construct($title)
    {
        $this->title = $title;
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
        $users = $notifiable->users;
        $devices = collect();

        foreach ($users as $user) {
            $user->user->devices->pluck('device_id')->filter(function ($item) use ($devices) {
                $devices->push($item);
            });
        }

        return new FirebaseMessage(
            $this->title,
            $notifiable->title,
            'osnova',
            [
                'screen' => 'OSNOVA_REPORTS',
                'id' => $notifiable->id
            ],
            $devices->toArray()
        );
    }
}
