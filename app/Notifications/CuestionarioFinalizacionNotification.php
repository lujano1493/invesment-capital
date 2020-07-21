<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CuestionarioFinalizacionNotification extends Notification
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
                    ->from("notification@capital444.com","Notificación Finalización de Cuestionario")
                    ->subject('Encuestas Finalizada')
                    ->greeting("Hola   {$this->data['nombre']},")
                    ->line( "el usuario: ".$this->data['correo']  ." ha terminado la encuesta." )
                    ->line(" Para poder ver los resultados, de clic en el siguiente botón.")
                    ->action('Ver Detalle', url(config('app.url') . route('admin.educacion.ver.resultado'  ,
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
