<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
    'name' => $this->name,
    'last_name' => $this->last_name,
    'email' => $this->email,
    'phone' => $this->phone,
    'profile_image_path' => $this->profile_image_path,
    'status' => $this->status ? $this->status->name : null,
    'city' => $this->city ? [
        'id' => $this->city->id,
        'name' => $this->city->name,
    ] : null,
    'is_admin' => $this->hasRole('admin'),
];
    }
}
