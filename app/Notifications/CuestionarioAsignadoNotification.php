<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CuestionarioAsignadoNotification extends Notification
{
    use Queueable;



    private $data=null;



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
                    ->from("notification@capital444.com","Notificación Asignacion de Cuestionario")
                    ->subject('Nueva Encuesta Asignada')
                    ->greeting("Hola   {$this->data['nombre']},")
                    ->line("Se ha asignado el cuestionario:  ". $this->data['nombre_encuesta']   )
                    ->line(" Para poder constestarla, de clic en el siguiente botón.")
                    ->action('Ver Detalle', url(config('app.url') . route('capital.cuestionario.contestar'  ,
                      ['id' => $this->data['id']]  ,false)))
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
