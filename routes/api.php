<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\InviteController;
use App\Http\Controllers\Api\v1\MasterDataController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\ClientController;

Route::prefix('v1')->group(function () {
    Route::get('cities', [MasterDataController::class, 'cities']);
    Route::get('statuses', [MasterDataController::class, 'statuses']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/car-brands', [MasterDataController::class, 'index']);
            Route::get('/car-models', [MasterDataController::class, 'models']);
            Route::get('/service', [MasterDataController::class, 'service']);
});
    
    //AUTH ROUTES
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::patch('register/{token}', [AuthController::class, 'register']);
        Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });
    //INVITE ROUTES
    Route::prefix('invites')->group(function () {
        Route::get('/validate/{token}', [InviteController::class, 'validateToken']);
        Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
            Route::post('/send', [InviteController::class, 'send']);
            Route::post('/resend', [InviteController::class, 'resend']);
        });
    });
    //USER ROUTES
    Route::prefix('user')->group(function () {
        Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/update-image', [UserController::class, 'updateImage']);
        Route::patch('/settings', [UserController::class, 'settings']);
        Route::patch('/change-password', [UserController::class, 'updatePassword']);
        });
    Route::middleware(['auth:sanctum','role:admin'])->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::delete('/delete/{user}', [UserController::class, 'deleteUser']);
        Route::patch('/deactivate/{user}', [UserController::class, 'deactivateUser']);
        Route::patch('/activate/{user}', [UserController::class, 'activateUser']);
        });
    });
    
    //CLIENT ROUTES
Route::middleware('auth:sanctum')->prefix('client')->group(function () {
    Route::post('/create', [ClientController::class, 'store']);
});
});


 