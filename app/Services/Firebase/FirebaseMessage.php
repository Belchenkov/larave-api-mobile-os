<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Services\Firebase;


class FirebaseMessage
{

    private $title;
    private $message;
    private $channel;
    private $data;
    private $token;

    /**
     * FirebaseMessage constructor.
     *
     * @param $title
     * @param $message
     * @param $channel
     * @param $data
     */
    public function __construct($title, $message, $channel, $data, $token)
    {
        $this->title = $title;
        $this->message = $message;
        $this->channel = $channel;
        $this->data = $data;
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

}
