<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            "kasir" => new KasirResource($this->kasir),
            "totalOrder" => $this->TotalOrder,
            "buyerName" =>$this->BuyerName,
            "tickets" => TicketResource::collection($this->tickets)
        ];
    }
}
