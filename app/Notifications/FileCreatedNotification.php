<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FileCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected int $ticketId, protected string $message, protected string $url)
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
            ->subject("Ticket ({$this->ticketId}) has received a new file")
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
