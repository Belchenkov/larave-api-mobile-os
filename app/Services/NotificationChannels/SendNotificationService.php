<?php


namespace App\Services\NotificationChannels;


use App\Models\UserDevice;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class SendNotificationService
{
    /**
     * @param null $title
     * @param null $body
     * @param null $channelId
     * @param null $data
     * @param null $token
     * @throws \LaravelFCM\Message\Exceptions\InvalidOptionsException
     */
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
            $tokens = UserDevice::pluck('device_id')->toArray();
            $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        }
    }
}
