<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClientRequest;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;






class ClientController extends Controller
{

protected ClientService $clientService;
////////////////////////////////////////////////////////////////////////////////////////CONSTRUCTOR
public function __construct(ClientService $clientService)
{
        $this->clientService = $clientService;
}
public function store(CreateClientRequest $request): JsonResponse
    {
        $clientResource = $this->clientService->createClient($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Client created successfully.',
            'data' => $clientResource,
        ], 201);
    }
}
