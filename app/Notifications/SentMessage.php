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
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
        //
    }

    public function broadcastOn(){

        $smallerId = min($this->message->recipient_id, $this->message->user_id);
        $largerId = max($this->message->recipient_id, $this->message->user_id);

        return new PrivateChannel('chat.' . $smallerId . '_' . $largerId);
    }

    public function broadcastAs(){
        return 'message-sent';
    }
}
