<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

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
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Data saved in DB
     */
    public function toDatabase($notifiable)
    {
        return [
            'type' => 'user_registered',
            'title' => 'New user registered',
            'message' => "{$this->user->name} has registered successfully.",
            'user_id' => $this->user->id,
        ];
    }

    /**
     * Data sent in realtime
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'type' => 'user_registered',
            'title' => 'New user registered',
            'message' => "{$this->user->name} has registered successfully.",
            'created_at' => now()->toDateTimeString(),
        ]);
    }
}
