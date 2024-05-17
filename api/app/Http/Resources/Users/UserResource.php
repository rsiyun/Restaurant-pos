<?php

namespace App\Http\Resources\Users;

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
            "idUser" => $this->idUser,
            "slug" => $this->slug,
            "name" => $this->name,
            "email" => $this->email,
            "role" => $this->role
        ];
    }
}
