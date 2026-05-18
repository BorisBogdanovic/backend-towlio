<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
public function getNotification()
    {
        $user = auth()->user();

        $notifications = $user->notifications()
            ->latest()
            ->take(50)
            ->get()
            ->map(function ($n) {

                $data = is_array($n->data)
                    ? $n->data
                    : json_decode($n->data, true);

                return [
                    'id' => $n->id,

                    'type' => $n->type,

                    'title' =>
                        $data['title'] ?? null,

                    'message' =>
                        $data['message'] ?? null,

                    'sender' =>
                        $data['sender'] ?? null,

                    'created_at' =>
                        $n->created_at?->toDateTimeString(),

                    'read_at' =>
                        $n->read_at?->toDateTimeString(),
                ];
            });

        return response()->json($notifications);
    }

public function clearNotifications()
{
    $user = auth()->user();

    $user->notifications()->delete();

    return response()->json([
        'status' => true,
        'message' => 'All notifications cleared successfully.',
    ]);
}

public function markAsRead(string $id)
{
    $user = auth()->user();

    $notification = $user->notifications()
        ->where('id', $id)
        ->first();

    if (!$notification) {
        return response()->json([
            'status' => false,
            'message' => 'Notification not found.',
        ], 404);
    }

    $notification->markAsRead();

    return response()->json([
        'status' => true,
        'message' => 'Notification marked as read.',
    ]);
}

public function markAllAsRead()
{
    $user = auth()->user();

    $user->unreadNotifications
        ->markAsRead();

    return response()->json([
        'status' => true,
        'message' => 'All notifications marked as read.',
    ]);
}
}