<?php

namespace App\Http\Resources\CarModel;

use Illuminate\Http\Resources\Json\JsonResource;

class CarModelRelationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'link' => $this->getLink(),
        ];
    }
}
