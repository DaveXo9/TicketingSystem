<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Ticket;
use Illuminate\Notifications\Messages\MailMessage;

class TicketAssigned extends Notification
{
    public function __construct(protected Ticket $ticket) {}

    public function via($notifiable): array
    {
        if (config('app.enable_notifications')) {
            return ['mail'];
        }

        return [];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = url('/tickets/' . $this->ticket->id); 
        return (new MailMessage)
            ->subject('You have been assigned a new ticket')
            ->line('You have been assigned a new ticket: ' . $this->ticket->title)
            ->action('View ticket', $url)
            ->line('Thank you!');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}