<?php

namespace App\Listeners;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use App\Notifications\TicketAssigned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveNotification implements ShouldQueue
{
    use Queueable;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(TicketAssigned $event)
    {
        $user = $event->ticket->user;
        $user->notify(new TicketAssigned($event->ticket));

        $notificationData = [
            'type' => 'ticket_assigned',
            'user_id' => $event->ticket->user_id,
            'data' => [
                'title' => $event->ticket->title,
                'created_at' => $event->ticket->created_at,
                'message' => $event->ticket->message,
            ],
        ];

        // Create a new notification
        Notification::create($notificationData);

        // Save the notification to the database
    }
}
