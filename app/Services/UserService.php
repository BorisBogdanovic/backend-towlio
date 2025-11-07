<?php

namespace App\Services;
use App\Models\User;
use App\Models\Invite; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;


class UserService
{
////////////////////////////////////////////////////////////////////////////////////////GET USERS SERVICE
public function getUsers(array $filters = [], int $perPage = 12)
    {
        $query = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->orderBy('name', 'ASC');
        
        if (!empty($filters['status'])) {
            $query->where('status_id', $filters['status']);
        }

        if (!empty($filters['city'])) {
            $query->where('city_id', $filters['city']);
        }

        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('name', 'LIKE', '%' . $filters['search'] . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $filters['search'] . '%');
            });
        }

        return $query->paginate($perPage);
    }
////////////////////////////////////////////////////////////////////////////////////////GET USERS SERVICE
public function deleteUser(User $user): array
{
        try {
            Invite::where('email', $user->email)->delete();
            $user->delete();

            return [
                'status' => true,
                'message' => 'User successfully deleted',
            ];
        } catch (\Exception $e) {
            Log::error('Error deleting user ID ' . $user->id . ': ' . $e->getMessage());

            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
}
////////////////////////////////////////////////////////////////////////////////////////DEACTIVATE USER SERVICE
public function deactivateUser(User $user): array
{
        if (!$user) {
            return [
                'status' => false,
                'message' => 'User not found.',
                'code' => 404
            ];
        }

        if ($user->status_id === 1) {
            $user->status_id = 3;
            $user->save();
            $user->tokens()->delete();
        }

        return [
            'status' => true,
            'message' => 'User has been deactivated.',
            'code' => 200
        ];
}
////////////////////////////////////////////////////////////////////////////////////////ACTIVATE USER SERVICE
public function activateUser(User $user): array
{
        if (!$user) {
            return [
                'status' => false,
                'message' => 'User not found.',
                'code' => 404
            ];
        }

        if ($user->status_id === 3) {
            $user->status_id = 1;
            $user->save();
           
        }

        return [
            'status' => true,
            'message' => 'User has been deactivated.',
            'code' => 200
        ];
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function updateAvatar(User $user, UploadedFile $file): User
{
        $timestamp = now()->timestamp;
        $ext = $file->getClientOriginalExtension();
        $slugName = Str::slug($user->name);
        $fileName = 'avatar_' . $user->id . '_' . $slugName . '_' . $timestamp . '.' . $ext;

      
        $path = $file->storeAs('images/avatars', $fileName, 'public');
        
        if ($user->profile_image_path !== 'images/default-profile.png' && Storage::disk('public')->exists($user->profile_image_path)) {
            Storage::disk('public')->delete($user->profile_image_path);
        }

        $user->profile_image_path = $path;
        $user->save();

        return $user;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function updateSettings(array $data): array
    {
        $user = Auth::user();

        $user->fill($data);
        $user->save();

        return [
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => new UserResource($user),
        ];
    }
}
