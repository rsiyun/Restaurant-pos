<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            "idOrder" => $this->idOrder,
            "totalOrder" => $this->TotalOrder,
            "BuyerName" => $this->BuyerName,
            "tickets" => OnlyTicketResource::collection($this->tickets),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
