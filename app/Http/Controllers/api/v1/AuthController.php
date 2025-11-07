<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Services\AuthService;


class AuthController extends Controller
{
protected AuthService $authService;
////////////////////////////////////////////////////////////////////////////////////////CONSTRUCTOR
public function __construct(AuthService $authService)
{
        $this->authService = $authService;
}
////////////////////////////////////////////////////////////////////////////////////////LOGIN
public function login(LoginRequest $request): JsonResponse
{
        try {
            $response =$this->authService->login($request->only('email', 'password'));
            return response()->json($response, $response['code']);
        } catch (\Exception $e) {
              Log::error('Login error: '.$e->getMessage(), [
            'email' => $request->email,
            'trace' => $e->getTraceAsString(),
        ]);
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.',
                'errors' => $e->getMessage(),
                'data' => null
            ], 500);
        }
}
///////////////////////////////////////////////////////////////////////////////////////LOGOUT
public function logout(): JsonResponse
{
    $response = $this->authService->logout();
    return response()->json($response, $response['code']);

}
///////////////////////////////////////////////////////////////////////////////////////FORGOT PASSWORD
public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
{
    try {
        $this->authService->forgotPassword($request->only('email'));
        return response()->json([
            'status' => 'If your email exists in our system, you will receive a reset link shortly.'
        ], 200);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong while sending reset link.'
        ], 500);
    }
}
///////////////////////////////////////////////////////////////////////////////////////RESET PASSWORD
public function resetPassword(ResetPasswordRequest $request): JsonResponse
{
    $response = $this->authService->resetPassword($request->only('email', 'password', 'token'));

    $statusCode = $response['status'] ? 200 : 422;

    return response()->json($response, $statusCode);
}
///////////////////////////////////////////////////////////////////////////////////////REGISTER USER
public function register(RegisterUserRequest $request, string $token): JsonResponse
{
    $response = $this->authService->registration(
        $token,
        $request->password,
        $request->city
    );

    return response()->json([
        'message' => $response['message'],
        'status'  => $response['status'],
        'data'    => $response['data'] ?? null,
    ], $response['code']);
}


}

