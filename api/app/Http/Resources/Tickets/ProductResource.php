<?php

namespace App\Http\Resources\Tickets;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "slug" => $this->slug,
            "productImage" => $this->productImage,
            "productName" => $this->productName,
            "productPrice" => $this->productPrice,
            "productType" => $this->productType,
        ];
    }
}