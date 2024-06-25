<?php

namespace App\Http\Resources\TicketDetails;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "slug" => $this->slug,
            "quantity" => $this->quantity,
            "priceTicketDetail" => $this->priceTicketDetail,
            "products" => new ProductResource($this->product)
        ];
    }
}
