<?php

namespace App\Notifications\Support;

use App\Mail\SupportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $to;
    public $comment;
    public $from;
    public $phone_work;
    public $phone_mobile;
    public $position_name;
    public $fio;
    public $mail;

    /**
     * Create a new notification instance.
     *
     * @param $to
     * @param $comment
     * @param $user
     */
    public function __construct($to, $comment, $user, $mail)
    {
        $this->to = $to;
        $this->mail = $mail;
        $this->comment = $comment;
        $this->from = $user->email;
        $this->phone_work = $user->phone_work;
        $this->phone_mobile = $user->phone_mobile;
        $this->position_name = $user->position_name;
        $this->fio = $user->last_name . ' ' . $user->first_name . ' ' . $user->middle_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SupportRequest
     */
    public function toMail($notifiable)
    {
        dd($notifiable->portalUser);
        return (new SupportRequest(
            $this->comment,
            $this->phone_work,
            $this->phone_mobile,
            $this->position_name,
            $this->fio))
            ->from($this->from, $this->fio)
            ->to($this->to);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
