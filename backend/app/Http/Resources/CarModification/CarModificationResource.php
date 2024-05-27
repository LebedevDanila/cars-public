<?php

namespace App\Http\Resources\CarModification;

use App\Http\Resources\Brand\BrandRelationResource;
use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->getId(),
            'name'       => $this->getName(),
            'image'      => new ImageResource($this->whenLoaded('image')),
            'specs'      => $this->getGroupedSpecs(),
            'equipments' => $this->getGroupedEquipments(),
        ];
    }
}
