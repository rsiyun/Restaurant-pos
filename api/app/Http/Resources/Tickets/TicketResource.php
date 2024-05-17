<?php

namespace App\Http\Resources\Tickets;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            "slug" => $this->slug,
            "buyerName" => $this->BuyerName,
            "priceTickets" => $this->priceTickets,
            "shop" => new ShopResource($this->shop),
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
        ];
    }
}