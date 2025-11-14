<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnalyticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'name' => $this->name . ' ' . $this->last_name,
            'total_clients' => $this->total_clients,
            'active_clients' => $this->active_clients,
            'inactive_clients' => $this->inactive_clients,
        ];
    }
}
