<?php
/**
 * Created by black40x@yandex.ru
 * Date: 30/09/2019
 */

namespace App\Services\NotificationChannels;


use Illuminate\Notifications\Notification;

class FirebaseChannel
{

    public function send($notifiable, Notification $notification)
    {
        $notification->toFirebase($notifiable);
    }

}
