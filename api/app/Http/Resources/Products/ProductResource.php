<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "shop" => new ShopResource($this->shop),
            "productImage" => $this->productImage,
            "productStock" => $this->productStock,
            "productName" => $this->productName,
            "productPrice" => $this->productPrice,
            "productType" => $this->productType
        ];
    }
}
