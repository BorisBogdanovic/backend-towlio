<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

  
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

   
    public function broadcastOn(): Channel
    {
        
        return new PrivateChannel('chat.' . $this->message->to_id);
    }

    
    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'message' => $this->message->message,
            'from_id' => $this->message->from_id,
            'to_id' => $this->message->to_id,
            'type' => $this->message->type,
            'file_path' => $this->message->file_path,
            'file_name' => $this->message->file_name,
            'file_size' => $this->message->file_size,
            'voice_duration' => $this->message->voice_duration,
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }
}
