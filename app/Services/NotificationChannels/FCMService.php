<?php


namespace App\Services\NotificationChannels;


use App\Models\User;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class FCMService
{
    public function send($title = null, $body = null, $channelId = null, $data = null, $token = null)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder
            ->setBody($body)
            ->setChannelId($channelId);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => $data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        if ($token) {
            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        } else {
            $tokens = User::pluck('id_device')->toArray();
            $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        }
    }
}
