<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SentMessage extends Notification implements ShouldBroadcast, ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $message;
    public $user;

    public function __construct(User $user, Message $message)
    {
        $this->message = $message;
        $this->user = $user;
        //
    }

    public function broadcastOn(){
        return new PrivateChannel('chat.' . $this->message->user_id);
    }

    public function broadcastAs(){
        return 'message.sent';
    }
}
