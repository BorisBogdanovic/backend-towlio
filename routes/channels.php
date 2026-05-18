<?php

use Illuminate\Support\Facades\Broadcast;

//CHAT
Broadcast::channel('chat.{userId}', function ($user, $userId) {
    
    return (int) $user->id === (int) $userId;
});

//NOTIFIKACIJE
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// ONLINE USERS
Broadcast::channel('online-users', function ($user) {
    return [
        'id' => $user->id,
        'name' => $user->name,
    ];
});

