<?php
/**
 * Created by black40x@yandex.ru
 * Date: 30/09/2019
 */

namespace App\Services\Firebase;


use Illuminate\Notifications\Notification;

class FirebaseChannel
{

    private $fcmSender;

    public function __construct()
    {
        $this->fcmSender = new FirebaseSender();
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFirebase($notifiable);

        if ($message != null)
            $this->fcmSender->send(
                $message->getTitle(),
                $message->getMessage(),
                $message->getChannel(),
                $message->getData(),
                $message->getToken()
            );
    }

}
