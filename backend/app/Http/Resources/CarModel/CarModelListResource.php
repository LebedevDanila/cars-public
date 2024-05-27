<?php

namespace App\Http\Resources\CarModel;

use App\Http\Resources\Brand\BrandRelationResource;
use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'     => $this->getId(),
            'image'  => new ImageResource($this->whenLoaded('image')),
            'name'   => $this->getName(),
            'link'   => $this->getLink(),
            'created_at' => $this->getCreatedAt(),
        ];
    }
}
