<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PeticionRetiroRealizadoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
      $this->data =$data;
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
          ->from("notification@capital444.com","Notificación de Retiro Realizado")
          ->subject('Retiro Realizado')
          ->greeting("Hola   {$this->data['name']},")
          ->line("Se ha realizado el retiro por $ ".number_format($this->data['monto'],2)  ." MXN ")
          ->line(" Para poder revisar los detalles del saldo, de clic en el siguiente botón.")
          ->action('Ver Detalle', url(config('app.url') . route('capital.invesment'  , false)))
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
