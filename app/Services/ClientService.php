<?php

namespace App\Services;

use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Auth;

class ClientService
{
   
    public function createClient(array $data): ClientResource
    {
     
       

        $client = Client::create([
            'client_name' => $data['client_name'],
            'client_last_name' => $data['client_last_name'],
            'address' => $data['address'] ?? null,
            'email' => $data['email'],
            'car_brand_id'=> $data['car_brand_id'],
            'car_model_id'=> $data['car_model_id'],
            'licence_plate' => $data['licence_plate'],
            'city' => $data['city'] ?? null,            
            'country' => $data['country'] ?? null,     
            'vin' => $data['vin'],
            'status' => $data['status'] ?? true,
            'phone'=>$data['phone']??null,
            'towlio_service_id' => $data['towlio_service_id'],
            'sales_person_id' =>  Auth::id(),
            'production_year'   => $data['production_year'] ?? null,
        ]);

        return new ClientResource($client);
    }
    /////////////////////////////////////////////////////////////////////////////////
   public function getClients($user, $search = null)
{
    if (!$user) {
        return [
            'status' => false,
            'code' => 401,
            'message' => 'Unauthorized',
            'data' => null,
            'meta' => null,
        ];
    }

    
    $query = Client::query();

    
    if (!$user->hasRole('admin')) {
        $query->where('user_id', $user->id);
    }

 
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('vin', 'like', "%$search%")
              ->orWhere('client_name', 'like', "%$search%")
              ->orWhere('client_last_name', 'like', "%$search%");
        });
    }

  
    $clients = $query->paginate(10);

    return [
        'status' => true,
        'code' => 200,
        'message' => 'Clients fetched successfully.',
        'data' => ClientResource::collection($clients),
        'meta' => [
            'current_page' => $clients->currentPage(),
            'per_page' => $clients->perPage(),
            'total' => $clients->total(),
            'last_page' => $clients->lastPage(),
        ],
    ];
}

}
