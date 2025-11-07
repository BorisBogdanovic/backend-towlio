<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\Invite;


class AuthService
{
///////////////////////////////////////////////////////////////////////////////////////LOGIN SERVICES    
public function login(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {
            return [
                'status' => false,
                'message' => 'The provided credentials are incorrect.',
                'data' => null,
                'code' => 401
            ];
        }

        $user = Auth::user();

        if ($user->status_id !== 1) {
            return [
                'status' => false,
                'message' => 'Your account is not active. Please contact support.',
                'data' => null,
                'code' => 403
            ];
        }

        return [
            'status' => true,
            'message' => 'Welcome ' . $user->name . ' ' . $user->last_name,
            'data' => new UserResource($user),
            'token' => $user->createToken('API token')->plainTextToken,
            'code' => 200
        ];
    }
///////////////////////////////////////////////////////////////////////////////////////LOGOUT SERVICES  
public function logout(): array
{
    try {
        $user = Auth::user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();

            return [
                'status' => true,
                'message' => 'The user has been successfully logged out',
                'code' => 200
            ];
        }

        return [
            'status' => false,
            'message' => 'No active session found',
            'code' => 400
        ];
    } catch (\Exception $e) {
        \Log::error('Logout error: '.$e->getMessage(), [
            'user_id' => $user?->id,
            'trace' => $e->getTraceAsString(),
        ]);

        return [
            'status' => false,
            'message' => 'Something went wrong during logout',
            'code' => 500
        ];
    }
}
///////////////////////////////////////////////////////////////////////////////////////FORGOT PASSWORD SERVICES 
public function forgotPassword(array $data): void
{
    $user = User::where('email', $data['email'])->first();

    if ($user) {
       $token = Password::createToken($user);
        $this->sendPasswordResetLink($user, $token);
    }
}
///////////////////////////////////////////////////////////////////////////////////////SEND LINK
public function sendPasswordResetLink($user, $token): void
{
    $frontendUrl = rtrim(config('app.frontend_url'), '/');
    $email = urlencode($user->email);
    $url = "{$frontendUrl}/reset-password?token={$token}&email={$email}";

   try {
    Mail::to($user->email)->queue(new ResetPasswordEmail($url, $user));
        } catch (\Exception $e) {
    \Log::error('Password reset email failed: '.$e->getMessage());
        }
}
///////////////////////////////////////////////////////////////////////////////////////RESET PASSWORD SERVICE
public function resetPassword(array $data): array
{
        $status = Password::reset(
            $data,
            function ($user) use ($data) {
                $user->update([
                    'password' => Hash::make($data['password']),
                ]);
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return [
                'status' => true,
                'message' => 'Password reset successfully',
            ];
        }

        return [
            'status' => false,
            'message' => 'Password reset failed',
            'error_code' => $status,
        ];
}

public function registration(string $token, string $password, int $city): array
{
    $invite = Invite::where('token', $token)->first();

    if (!$invite) {
        return [
            'status' => false,
            'message' => 'Token expired or invalid.',
            'code' => 404,
        ];
    }
    if ($invite->expires_at && $invite->expires_at->isPast()) {
    return [
        'status' => false,
        'message' => 'Invite token has expired.',
        'code' => 410,
    ];
}

    $user = User::where('email', $invite->email)->first();

    if (!$user) {
        return [
            'status' => false,
            'message' => 'User not found.',
            'code' => 404,
        ];
    }

    try {
        $user->update([
            'password'  => Hash::make($password),
            'status_id' => 1,
            'city_id'   => $city,
        ]);

        $invite->delete();

        return [
            'status'  => true,
            'message' => 'Registration successful.',
            'data'    => new UserResource($user),
            'code'    => 200,
        ];

    } catch (\Throwable $e) {
        Log::error('Registration failed', [
            'error' => $e->getMessage(),
            'user_email' => $invite->email,
        ]);

        return [
            'status'  => false,
            'message' => 'An unexpected error occurred while completing registration.',
            'code'    => 500,
        ];
    }
}
}
