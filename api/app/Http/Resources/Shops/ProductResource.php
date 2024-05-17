<?php

namespace App\Http\Resources\Shops;

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
            "idProduct" => $this->idProduct,
            "slug" => $this->slug,
            "productImage" => $this->productImage,
            "productName" => $this->productName,
            "productPrice" => $this->productPrice,
            "productType" => $this->productType
        ];
    }
}
