<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "totalOrder" => $this->totalOrder,
            "buyerName" => $this->buyerName,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "kasir" => new KasirResource($this->kasir)
        ];
    }
}
