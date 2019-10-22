<?php

namespace App\Notifications\News;

use App\Models\News;
use App\Models\UserDevice;
use App\Services\Firebase\FirebaseChannel;
use App\Services\Firebase\FirebaseMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewNewsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $newsTitle;

    /**
     * Create a new notification instance.
     *
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->newsTitle = $news->title;
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
            'ГК Основа: Добавлена новость',
            $this->newsTitle,
            'push-channel',
            '',
            UserDevice::all()->pluck('device_id')->toArray()
        );
    }
}
