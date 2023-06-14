<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class TicketAssigned extends Notification implements ShouldBroadcast, ShouldQueue
{
    use Queueable;
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(public Ticket $ticket) {}

    public function via($notifiable): array
    {
        if (config('app.enable_notifications')) {
            return ['mail','broadcast'];
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


    
    /**
     * Get the broadcast representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function broadcastWith()
    {
        $url = url('/tickets/' . $this->ticket->id); 

        return [
            'title' => 'New ticket assigned: ' . $this->ticket->title,
            'created_at' => $this->ticket->created_at,
            'message' => 'You have been assigned a new ticket: ' . $this->ticket->title . ' Ticket has priority: ' . $this->ticket->priority,
            'url' => '/tickets/' . $this->ticket->id,
            'user_id' => $this->ticket->user_id,
        ];
    }
    public function broadcastOn()
    {
        // private channel
        return new PrivateChannel('notifications.' . $this->ticket->user_id);
    }
  
    public function broadcastAs()
    {
        return 'ticket-assigned';
    }
    
    public function toArray($notifiable): array
    {
        return [
            
        ];
    }
}