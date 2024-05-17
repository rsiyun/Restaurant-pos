<?php

namespace App\Http\Resources\Shops;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            "idShop" => $this->idShop,
            "ownerName" => $this->ownerName,
            "slug" => $this->slug,
            "shopName" => $this->shopName,
            "isActive" => $this->isActive,
            "products" => ProductResource::collection($this->products)
        ];
    }
}
