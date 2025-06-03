<?php

namespace App\Http\Resources\Students;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid' =>           $this->uuid,
            'name' =>           $this->name,
            'email' =>          $this->email,
            'description' =>    $this->description,
            'role' =>           $this->role,
            'created_at' =>     $this->created_at?->toDateTimeString(),
            'updated_at' =>     $this->updated_at?->toDateTimeString(),
        ];
    }
}
