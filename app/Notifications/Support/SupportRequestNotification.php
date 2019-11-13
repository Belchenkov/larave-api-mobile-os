<?php

namespace App\Notifications\Support;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SupportRequestNotification extends Notification
{
    use Queueable;

    private $to;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($to)
    {
        $this->to = $to;
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
    //  $notifiable->email = $this->to;
        $notifiable->email = 'belchenkov@yksoft.ru';

        return (new MailMessage)
                    ->subject('Мобильного приложения сотрудника ГК Основа')
                    ->from('test@example.com', 'Example')
                    ->line('Заявка сформирована с помощью Мобильного приложения сотрудника ГК Основа')
                    ->line('Пользователем: Чурсин Сергей Юрьевич')
                    ->line('должность Руководитель проектов автоматизации')
                    ->line('тел.  2199')
                    ->line('Мобильный  ___________');
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
