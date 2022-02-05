<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
            ->subject('Redefinir senha')
            ->greeting('Olá!')
            ->line('Alguém solicitou recentemente uma alteração de senha da sua conta da Ulhoa mods. Se foi você, clique no botão abaixo para redefinir sua senha:')
            ->action('REDEFINIR SENHA', route('password.reset', $this->token))
            ->line('Se não quiser alterar a senha ou não tiver feito essa solicitação, basta ignorar e excluir esta mensagem.')
            ->line('Para manter sua conta segura, não encaminhe este e-mail para ninguém.')
            ->markdown('vendor.notifications.email');
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
