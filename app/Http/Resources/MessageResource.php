<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'from_id' => $this->from_id,
            'to_id' => (int) $this->to_id,

            'type' => $this->type,

            'message' => $this->type === 'text' ? $this->message : null,

            'file_url' => $this->type !== 'text' ? $this->file_url : null,
'file_name' => $this->type !== 'text' ? $this->file_name : null,
'file_size' => $this->type !== 'text' ? $this->file_size : null,

            'voice_duration' => $this->voice_duration,

            'read_at' => $this->read_at,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}