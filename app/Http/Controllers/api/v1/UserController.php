<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GetUsersRequest;
use App\Http\Requests\UpdateUserImageRequest;
use App\Http\Requests\UserSettingsReqeust;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Models\User;

use Illuminate\Support\Facades\Hash;





class UserController extends Controller
{

protected UserService $userService;
////////////////////////////////////////////////////////////////////////////////////////CONSTRUCTOR
public function __construct(UserService $userService)
{
        $this->userService =  $userService;
}
////////////////////////////////////////////////////////////////////////////////////////GETTING USERS
public function index(GetUsersRequest $request):JsonResponse 
{
$users = $this->userService->getUsers($request->only(['status', 'city', 'search']), 12);

  return response()->json([
    'success' => true,              
    'message' => 'Users retrieved successfully',
    'data' => [
        'users' => UserResource::collection($users), 
        'pagination' => [
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
        ]
    ]
],200);
}
////////////////////////////////////////////////////////////////////////////////////////DELETING USER
public function deleteUser(User $user): JsonResponse
    {
        $result = $this->userService->deleteUser($user);

        $statusCode = $result['status'] ? 200 : 500;

        return response()->json($result, $statusCode);
    }
////////////////////////////////////////////////////////////////////////////////////////DEACTIVATE USER
public function deactivateUser(User $user): JsonResponse
{
        $result = $this->userService->deactivateUser($user);

        return response()->json([
            'status' => $result['status'],
            'message' => $result['message'],
        ], $result['code']);
}
////////////////////////////////////////////////////////////////////////////////////////ACTIVATE USER
public function activateUser(User $user): JsonResponse
{
        $result = $this->userService->activateUser($user);

        return response()->json([
            'status' => $result['status'],
            'message' => $result['message'],
        ], $result['code']);
}
////////////////////////////////////////////////////////////////////////////////////////
public function updateImage(UpdateUserImageRequest $request): JsonResponse
{
    $user = auth()->user();

    if (!$request->hasFile('avatar')) {
        return response()->json([
            'status' => 'error',
            'message' => 'No avatar file uploaded.'
        ], 422);
    }

 
    $updatedUser = $this->userService->updateAvatar($user, $request->file('avatar'));

     return response()->json([
        'status'  => true,
        'message' => 'Avatar updated successfully!',
        'data' => new UserResource($updatedUser),
    ],200);
}
////////////////////////////////////////////////////////////////////////////////////////   
public function settings(UserSettingsReqeust $request): JsonResponse
    {
        $data = $request->only(['name', 'last_name', 'phone', 'city_id']);
        $response = $this->userService->updateSettings($data);

        return response()->json($response);
    }

////////////////////////////////////////////////////////////////////////////////////////   
public function updatePassword(UpdatePasswordRequest $request): JsonResponse
{
    $user = auth()->user();

    
    $user->password = Hash::make($request->password);
    $user->save();

    return response()->json([
    'status' => true,
    'message' => 'Password updated successfully!'
], 200);
}
}


