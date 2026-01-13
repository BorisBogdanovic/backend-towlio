<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Requests\SendMessageRequest;
use App\Models\Message;
use App\Events\MessageSent;



class ChatController extends Controller
{
    
public function getUsers()
{
    $authUser = Auth::user();
    if ($authUser->hasRole('admin')) {
       $users = User::where('id', '!=', $authUser->id)
                     ->where('status_id', 1)
                     ->get();
    } else {
        $users = User::role('admin')
                     ->where('status_id', 1)
                     ->get();
    }

    return UserResource::collection($users);
}

 public function sendMessage(SendMessageRequest $request)
{
    $authUser = Auth::user();

    
    $message = Message::create([
        'from_id' => $authUser->id,
        'to_id' => $request->to_id,
        'message' => $request->message,
        'type' => $request->type,
        'file_path' => $request->file_path,
        'file_name' => $request->file_name,
        'file_size' => $request->file_size,
        'voice_duration' => $request->voice_duration,
    ]);

    
    broadcast(new MessageSent($message))->toOthers();

    return response()->json([
        'success' => true,
        'message' => $message,
    ]);
}

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

}
