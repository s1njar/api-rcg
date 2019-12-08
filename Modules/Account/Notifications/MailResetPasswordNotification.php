<?php

namespace Modules\Account\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class MailResetPasswordNotification
 */
class MailResetPasswordNotification extends ResetPassword
{
    use Queueable;

    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Here is your verification token.')
            ->line($this->token)
            ->line('Thank you for using our application!');
    }
}
