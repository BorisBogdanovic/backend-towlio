<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // 🔥 odmah šalje (bez queue)
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    public function __construct(Message $message)
    {
        // 🔥 Ako ćeš koristiti relacije (npr. from user), učitaj ih ovde
        $this->message = $message->loadMissing(['from']);
    }

    /**
     * 🔥 Na koje kanale ide event
     * - primalac (to_id)
     * - pošiljalac (from_id) → sync oba klijenta
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->message->to_id),
            new PrivateChannel('chat.' . $this->message->from_id),
        ];
    }

    /**
     * 🔥 Custom ime eventa (frontend sluša ovo)
     */
    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    /**
     * 🔥 Payload koji ide na frontend
     */
public function broadcastWith(): array
{
    return [
        'id' => $this->message->id,
        'from_id' => $this->message->from_id,
        'to_id' => $this->message->to_id,
        'type' => $this->message->type,

        'message' => $this->message->type === 'text'
            ? $this->message->message
            : null,

        'file_url' => $this->message->type !== 'text'
            ? $this->message->file_url
            : null,

        'file_name' => $this->message->type !== 'text'
            ? $this->message->file_name
            : null,

        'file_size' => $this->message->type !== 'text'
            ? $this->message->file_size
            : null,

        'voice_duration' => null,

        'from_user' => [
            'id' => $this->message->from->id ?? null,
            'name' => $this->message->from->name ?? null,
        ],

        'created_at' => $this->message->created_at->toISOString(),
    ];
}
}