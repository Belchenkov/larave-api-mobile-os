<?php

namespace App\Notifications\Push;

use App\Services\Firebase\FirebaseChannel;
use App\Services\Firebase\FirebaseMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPush extends Notification implements ShouldQueue
{
    use Queueable;

    private $title;
    private $message;
    private $data;

    /**
     * Create a new notification instance.
     *
     * @param $title
     * @param $message
     * @param $data
     */
    public function __construct($title, $message, $data)
    {
        $this->title = $title;
        $this->message = $message;
        $this->data = $data;
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
            $this->title,
            $this->message,
            'First Channel',
            $this->data,
            $notifiable->devices->pluck('device_id')->toArray()
        );
    }
}
