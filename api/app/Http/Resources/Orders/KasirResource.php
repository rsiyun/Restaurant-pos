<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KasirResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            "idKasir" => $this->idKasir,
            "slug" => $this->slug,
            "name" => $this->name,
            "email" => $this->email
        ];
    }
}
