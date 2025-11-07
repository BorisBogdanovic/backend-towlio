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
}
