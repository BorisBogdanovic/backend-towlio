<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
     {
        return [
        'id' => $this->id,
        'client_name' => $this->client_name,
        'client_last_name' => $this->client_last_name,
        'address' => $this->address,
        'email' => $this->email,
        'car_brand' => [
            'id' => $this->car_brand_id,
            'name' => $this->brand->name ?? null,
        ],
        'car_model' => [
            'id' => $this->car_model_id,
            'name' => $this->model->name ?? null,
        ],
        'production_year' => $this->production_year ?? null,
        'licence_plate' => $this->licence_plate,
        'vin' => $this->vin,
        'start_date' => optional($this->start_date)->format('Y-m-d'),
        'expired_date' => optional($this->expired_date)->format('Y-m-d'),
        'status' => $this->status,
        'service' => [
            'id' => $this->towlio_service_id,
            'name' => $this->service->name ?? null,
        ],
        'sales_person' => [
            'id' => $this->sales_person_id,
            'name' => $this->salesPerson->name ?? null,
            'email' => $this->salesPerson->email ?? null,
        ],
    ];
    }
}
