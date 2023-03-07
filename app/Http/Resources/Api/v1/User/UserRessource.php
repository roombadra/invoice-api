<?php

namespace App\Http\Resources\Api\v1\User;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRessource extends JsonResource
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
            'email' => $this->email,
            'profile' => $this->profile_id == Profile::ADMIN['id'] ? Profile::ADMIN['name'] : Profile::USER['name'],
            'created_at' => $this->created_at,
        ];
    }
}
