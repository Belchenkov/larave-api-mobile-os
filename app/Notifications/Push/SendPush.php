<?php

namespace App\Notifications\Push;

use App\Services\NotificationChannels\SendNotificationService;
use App\Services\NotificationChannels\FirebaseChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPush extends Notification implements ShouldQueue
{
    use Queueable;

    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
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
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @param SendNotificationService $service
     * @return void
     */
    public function toFirebase($notifiable)
    {
       (new SendNotificationService)->send(
            'Test Title',
            'Test Body',
            'First Channel',
            'Test Data'
       );
    }
}
