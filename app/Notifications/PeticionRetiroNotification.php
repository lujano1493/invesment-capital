<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PeticionRetiroNotification extends Notification
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
             ->from("notification@capital444.com","Notificación de Retiro")
             ->subject('Petición de retiro')
             ->greeting("Hola administrador  {$this->data['nickname']},")
             ->line("Se ha realizado una petición de retiro por $ ".number_format($this->data['monto'],2)  ." MXN  del siguiente usuario:")
             ->line("Correo Electrónico :   {$this->data['email'] } ")
             ->line(" Para poder revisar el movimiento da clic en el siguiente botón.")
             ->action('Ver Detalle', url(config('app.url') . route('admin.invesment.balances',['id' => $this->data['idUser']  ], false)))
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
