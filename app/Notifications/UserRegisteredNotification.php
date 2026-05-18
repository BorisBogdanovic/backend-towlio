<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class UserRegisteredNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Channels
     */
    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Custom broadcast event name
     */
    public function broadcastType(): string
    {
        return 'user.registered';
    }

    /**
     * Shared notification payload
     */
    protected function payload(): array
    {
        return [
            'type' => 'user_registered',

            'title' =>
                "{$this->user->name} {$this->user->last_name}",

            'message' => 'has registered successfully.',

            'user_id' => $this->user->id,

            'sender' => [
                'id' => $this->user->id,

                'name' =>
                    "{$this->user->name} {$this->user->last_name}",

                'avatar' => $this->user->profile_image_path
                    ? asset($this->user->profile_image_path)
                    : null,
            ],

            'created_at' => now()->toISOString(),
        ];
    }

    /**
     * Data saved in DB
     */
    public function toDatabase($notifiable): array
    {
        return $this->payload();
    }

    /**
     * Data sent in realtime
     */
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage(
            $this->payload()
        );
    }
}