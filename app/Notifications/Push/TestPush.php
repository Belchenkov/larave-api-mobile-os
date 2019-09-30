<?php

namespace App\Notifications\Push;

use App\Services\NotificationChannels\FCMService;
use App\Services\NotificationChannels\FirebaseChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestPush extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
     * @param FCMService $service
     * @return void
     */
    public function toFirebase($notifiable, FCMService $service)
    {
        $service->send(
            'Test Title',
            'Test Body',
            'First Channel',
            'Test Data',
            '43523452345234'
        );
    }
}
