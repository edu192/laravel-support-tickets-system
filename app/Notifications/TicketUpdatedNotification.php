<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public function __construct(protected int $ticketId, protected string $subject, protected string $message, protected string $url)
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
