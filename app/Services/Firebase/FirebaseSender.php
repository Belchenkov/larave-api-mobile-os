<?php


namespace App\Services\Firebase;


use App\Models\UserDevice;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class FirebaseSender
{
    /**
     * @param null $title
     * @param null $body
     * @param null $channelId
     * @param null $data
     * @param array $tokens
     * @throws \LaravelFCM\Message\Exceptions\InvalidOptionsException
     */
    public function send($title = null, $body = null, $channelId = null, $data = null, $tokens = [])
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)->setChannelId($channelId);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => $data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
    }
}
