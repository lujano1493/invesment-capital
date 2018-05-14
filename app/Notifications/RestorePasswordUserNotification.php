<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RestorePasswordUserNotification extends Notification
{
    use Queueable;


    private $data=null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
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
        return (new MailMessage)
            ->subject('Recuperación de Contraseña')
            ->greeting("Hola {$this->data['name']} {$this->data['last_name']},")
            ->line('Hemos recibido una solicitud para el cambio de contraseña')
            ->action('Restablecer contraseña', url(config('app.url').route('restore_password', $this->data['token'], false)))
            ->line('si no envio una solicitud de recuperacion de contraseña, no haga caso al correo.')
            ->salutation('');
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
