<?php

namespace App\Notifications\Kip;

use App\Services\Firebase\FirebaseChannel;
use App\Services\Firebase\FirebaseMessage;
use App\Structure\Portal\PortalMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class HandlePushNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $push;

    /**
     * Create a new notification instance.
     *
     * @param $push
     */
    public function __construct($push)
    {
        $this->push = $push;
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
            isset($this->push['title']) ? $this->push['title'] : '',
            Str::limit($this->push['message'], 255),
            'osnova',
            $this->getData($this->push['type']),
            $notifiable->devices->pluck('device_id')->toArray()
        );
    }

    /**
     * @param $type_push
     * @return array
     */
    public function getData(string $type_push): array
    {
        $data = [
            'data' => $this->push['data']
        ];

        switch ($type_push) {
            case PortalMessage::KIP_NEW:
                $data += ['screen' => 'OSNOVA_TASKS_LIST'];
                break;
            case PortalMessage::KIP_UPDATE:
            case PortalMessage::KIP_COMMENT:
                $data += ['screen' => 'OSNOVA_TASKS_INFO'];
                break;
            default:
                $data += ['screen' => 'OSNOVA_MAIN_SCREEN'];
                break;
        }

        return $data;
    }
}
