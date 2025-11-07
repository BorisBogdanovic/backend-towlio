<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InviteService;
use App\Http\Requests\InviteUserRequest;
use App\Http\Requests\InviteResendRequest;
use App\Http\Resources\InviteResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;



class InviteController extends Controller
{
protected InviteService $inviteService;
////////////////////////////////////////////////////////////////////////////////////////CONSTRUCTOR
public function __construct(InviteService $inviteService)
{
        $this->inviteService = $inviteService;
}
////////////////////////////////////////////////////////////////////////////////////////SEND INVITE
public function send(InviteUserRequest $request): JsonResponse
{
    $response = $this->inviteService->sendInvite($request->validated());

    return response()->json([
        'message' => $response['mail_status'] === 'success' 
                     ? 'Invitation sent successfully' 
                     : 'Invitation created, but failed to send email',
        'status'  => $response['mail_status'],
        'data'    => [
            'invite' => new InviteResource($response['invite']),
            
        ],
    ], 201);
}
////////////////////////////////////////////////////////////////////////////////////////VALIDATE INVITE TOKEN
public function validateToken(string $token): JsonResponse
    {
        $response = $this->inviteService->validateToken($token);

        return response()->json([
            'message' => $response['message'],
            'status' => $response['status'],
            'data' => new InviteResource($response['data'] ?? null),
        ], $response['code']);
    }
////////////////////////////////////////////////////////////////////////////////////////RESEND INVITE
public function resend(InviteResendRequest $request): JsonResponse
{
        $response = $this->inviteService->resendInvite($request->email);

        if (!$response['status']) {
            return response()->json([
                'message' => $response['message'],
                'error'   => $response['error'] ?? null,
            ],$response['code'] ?? 500);
        }

        return response()->json([
            'message' => $response['message'],
            'status' => $response['status'],
            'data'    => new InviteResource($response['invite']),
        ], $response['code']);
}
}

