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
    public $mail;

    /**
     * Create a new notification instance.
     *
     * @param $to
     * @param $comment
     * @param $mail
     */
    public function __construct($to, $comment, $mail)
    {
        $this->to = $to;
        $this->mail = $mail;
        $this->comment = $comment;
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
        $user = $notifiable->portalUser;
        $fio = $user->last_name . ' ' . $user->first_name . ' ' . $user->middle_name;

        return (new SupportRequest(
            $this->comment,
            $user->phone_work,
            $user->phone_mobile,
            $user->position_name,
            $fio))
            ->from($user->email, $fio)
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
