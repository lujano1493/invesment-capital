<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActiveUserNotification extends Notification
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
            ->from("notification@capital444.com.mx","Activación Cuenta Capital 444")
            ->subject('Activación de Cuenta')
            ->greeting("Bienvenido {$this->data['name']} {$this->data['last_name']},")
            ->line("Se creado una cuenta en el portal Invesment Capital con las siguiente información:")
            ->line("Correo Electrónico :   {$this->data['email'] } ")
            ->line("Contraseña: {$this->data['password']}")
            ->line(" Para poder ingresar al portal debe dar click en el siguiente boton")
            ->action('Activar Cuenta', url(config('app.url') . route('active.user', [ 
                        "email" => $this->data['email'],
                        "password" => $this->data['password'] ,
                        "token"=> $this->data['token'] 
                    ], false))) 
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
