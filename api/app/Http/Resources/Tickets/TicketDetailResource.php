<?php

namespace App\Http\Resources\Tickets;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            "slug" => $this->slug,
            "quantity" => $this->quantity,
            "priceTicketDetail" => $this->priceTicketDetail,
            "product" => new ProductResource($this->product)
        ];
    }
}
