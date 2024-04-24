<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketUpdatedNotification extends Notification
{
    public function __construct(protected Ticket $comment, protected string $subject, protected string $message, protected string $url)
    {
    }

    public function via($notifiable)
    : array
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    : MailMessage
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->greeting('Greetings!')
            ->line($this->message)
            ->action('View', url($this->url));
    }

    public function toArray($notifiable)
    : array
    {
        return [];
    }
}
