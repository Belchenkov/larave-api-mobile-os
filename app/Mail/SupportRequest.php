<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportRequest extends Mailable
{
    use Queueable, SerializesModels;

    private $comment;
    private $phone_work;
    private $phone_mobile;
    private $position_name;
    private $fio;

    /**
     * Create a new message instance.
     *
     * @param $comment
     * @param $phone_work
     * @param $phone_mobile
     * @param $position_name
     * @param $fio
     */
    public function __construct($comment, $phone_work, $phone_mobile, $position_name, $fio)
    {
        $this->comment = $comment;
        $this->phone_work = $phone_work;
        $this->phone_mobile = $phone_mobile;
        $this->position_name = $position_name;
        $this->fio = $fio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.notifications.requests.support', [
                'comment' => $this->comment,
                'fio' => $this->fio,
                'phone_work' => $this->phone_work,
                'phone_mobile' => $this->phone_mobile,
                'position_name' => $this->position_name
            ])
            ->subject('Мобильное приложение сотрудника ГК Основа');
    }
}
