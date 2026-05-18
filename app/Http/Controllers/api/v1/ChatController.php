<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\MessageResource;
use App\Http\Requests\SendMessageRequest;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Storage;



class ChatController extends Controller
{


public function sendMessage(SendMessageRequest $request)
{
    $authUser = auth()->user();
    $type = $request->type;

    $filePath = null;
    $fileName = null;
    $fileSize = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');

        $folder = $type === 'image' ? 'chat-images' : 'chat-files';

        $filePath = $file->store($folder, 'public');
        $fileName = $file->getClientOriginalName();
        $fileSize = $file->getSize();
    }

    $message = Message::create([
        'from_id' => $authUser->id,
        'to_id' => $request->to_id,
        'type' => $type,
        'message' => $type === 'text' ? $request->message : null,
        'file_path' => $filePath,
        'file_name' => $fileName,
        'file_size' => $fileSize,
        'voice_duration' => null,
    ]);

    broadcast(new MessageSent($message))->toOthers();

    return response()->json([
        'success' => true,
        'message' => new MessageResource($message),
    ]);
}
    
public function getUsers(Request $request)
{
    $authUser = Auth::user();

    $validated = $request->validate([
        'search' => ['nullable', 'string', 'max:50'],
    ]);

    $search = trim($validated['search'] ?? '');

    // 🔹 BASE QUERY
    $query = $authUser->hasRole('admin')
        ? User::where('id', '!=', $authUser->id)->where('status_id', 1)
        : User::role('admin')->where('status_id', 1);

    // 🔹 SEARCH
    if ($search !== '') {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('last_name', 'LIKE', "%{$search}%");
        });
    }

    $users = $query->get();

    // 🔹 OPTIMIZATION: UZMI SVE PORUKE ODMAH
    $messages = Message::where(function ($q) use ($authUser, $users) {
            $q->where('to_id', $authUser->id)
              ->orWhere('from_id', $authUser->id);
        })
        ->whereIn('from_id', $users->pluck('id')->push($authUser->id))
        ->whereIn('to_id', $users->pluck('id')->push($authUser->id))
        ->get()
        ->groupBy(function ($msg) use ($authUser) {
            return $msg->from_id === $authUser->id
                ? $msg->to_id
                : $msg->from_id;
        });

    // 🔹 TRANSFORM
    $users = $users->map(function ($user) use ($messages, $authUser) {

        $userMessages = $messages->get($user->id, collect());

        $latestMessage = $userMessages->sortByDesc('created_at')->first();

        $unreadCount = $userMessages
            ->where('to_id', $authUser->id)
            ->whereNull('read_at')
            ->count();

        $user->latest_message = $latestMessage?->message;
        $user->latest_message_time = $latestMessage?->created_at?->toDateTimeString();
        $user->unread_count = $unreadCount;

        return $user;
    });

    // 🔹 SORT (isti kao kod tebe)
    $users = $users->sortByDesc('latest_message_time')->values();

    return UserResource::collection($users);
}
////////////////////////////////////////////////////////////////////////////////



public function getMessages($contactId)
{
    $authUser = auth()->user();
    $contact = User::findOrFail($contactId);

    $messages = $authUser->messagesWith($contactId)
        ->orderBy('created_at', 'asc')
        ->get();

    return response()->json([
        'contact' => $contact,
        'messages' => $messages,
    ]);
}

public function markAsRead($contactId)
{
    $authUser = Auth::user();
    Message::where('from_id',$contactId)
        ->where('to_id',$authUser->id)
        ->whereNull('read_at')
        ->update(['read_at' => now(),]);

    return response()->json([
        'success' => true,
    ]);
}
}
