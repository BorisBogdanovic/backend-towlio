<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Mail\InvitationEmail;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InviteService
{
////////////////////////////////////////////////////////////////////////////////////////SEND INVITE SERVICE
  public function sendInvite(array $data): array
    {
        $token = Str::random(30);

        $invite = Invite::create([
            'email'     => $data['email'],
            'name'      => $data['name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'token'     => $token,
            'expires_at' => now()->addHours(48)
        ]);

        $user = User::create([
            'email'     => $invite->email,
            'password'  => Hash::make(Str::random(10)),
            'name'      => $invite->name,
            'last_name' => $invite->last_name,
            'phone'     => $invite->phone,
            'status_id' => 2,
        ])->assignRole('user');

        $url = env('FRONTEND_URL') . "/register/{$invite->email}/{$token}/{$user->name}/{$user->last_name}";
        $mailStatus = true;

        try {
            Mail::to($invite->email)->queue(new InvitationEmail($url, $invite->email, $invite));
        } catch (\Throwable $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            $mailStatus = false;
        }

        return [
            'invite' => $invite,
            'user' => $user,
            'mail_status' => $mailStatus,
        ];
    }
////////////////////////////////////////////////////////////////////////////////////////CHECK INVITE SERVICE
public function validateToken(string $token): array
    {
        $invite = Invite::where('token', $token)->first();
        $user = User::where('email',$invite->email)->first();

        if (!$invite) {
            return [
                'message' => 'Invalid or expired token',
                'status' => false,
                'code' => 404
            ];
        }

         if ($invite->expires_at && $invite->expires_at->isPast()) {

             $invite->delete();
             $user->delete();
        return [
            'message' => 'Invite token has expired.',
            'status' => false,
            'code' => 410
        ];
    }
        return [
            'message' => 'Token is valid',
            'status' => true,
            'data' => $invite,
            'code' => 200
        ];
    }
////////////////////////////////////////////////////////////////////////////////////////RESEND INVITE SERVICE
public function resendInvite(string $email): array
{
        $invite = Invite::where('email', $email)->first();

        if (!$invite) {
            return [
                'status'  => false,
                'message' => 'Invitation not found.',
            ];
        }

        $token = Str::random(30);
        $invite->update([
            'token' => $token,
            'expires_at' => now()->addHours(48)
        ]);
        $url = env('FRONTEND_URL') . "/register/{$invite->email}/{$token}/{$invite->name}/{$invite->last_name}";

        try {
            Mail::to($invite->email)->queue(new InvitationEmail($url, $invite->email, $invite));
        } catch (\Throwable $e) {
            return [
                'status'  => false,
                'message' => 'Failed to send invitation email.',
                'error'   => $e->getMessage(),
            ];
        }
        return [
            'status'  => true,
            'message' => 'Invitation re-sent successfully.',
            'invite'  => $invite,
            'code' => 200
        ];
    }
}
