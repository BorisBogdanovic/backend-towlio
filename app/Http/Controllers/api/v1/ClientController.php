<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClientRequest;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Requests\SearchClientsRequest;






class ClientController extends Controller
{

protected ClientService $clientService;
////////////////////////////////////////////////////////////////////////////////////////CONSTRUCTOR
public function __construct(ClientService $clientService)
{
        $this->clientService = $clientService;
}
////////////////////////////////////////////////////////////////////////////////////////CREATING CLIENT
public function store(CreateClientRequest $request): JsonResponse
    {
        $clientResource = $this->clientService->createClient($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Client created successfully.',
            'data' => $clientResource,
        ], 201);
    }
////////////////////////////////////////////////////////////////////////////////////////LISTING CLIENTS

public function getClients(SearchClientsRequest $request): JsonResponse
{
    $user = auth()->user();
    $search = request()->query('search'); 

    $response = $this->clientService->getClients($user, $search);

    return response()->json([
        'status' => $response['status'],
        'message' => $response['message'],
        'data' => $response['data'],
        'meta' => $response['meta'],
    ], $response['code']);
}
}
