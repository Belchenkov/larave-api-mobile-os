<?php

namespace App\Notifications\Support;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SupportRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $to;
    private $comment;
    private $from;
    private $phone_work;
    private $phone_mobile;
    private $position_name;
    private $fio;

    /**
     * Create a new notification instance.
     *
     * @param $to
     * @param $comment
     * @param $user
     */
    public function __construct($to, $comment, $user)
    {
        $this->to = $to;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $notifiable->email = $this->to;

       return (new MailMessage)
           ->from($this->from, $this->fio)
           ->subject('Мобильное приложение сотрудника ГК Основа')
           ->markdown('emails.notifications.requests.support', [
               'comment' => $this->comment,
               'fio' => $this->fio,
               'phone_work' => $this->phone_work,
               'phone_mobile' => $this->phone_mobile,
               'position_name' => $this->position_name
           ]);
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
