<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        return [
            'idUser' => $this->idUser,
            'idShop' => $this->idShop,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'isActive' => $this->isActive,
        ];
    }
}
