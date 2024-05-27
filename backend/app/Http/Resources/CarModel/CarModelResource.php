<?php

namespace App\Http\Resources\CarModel;

use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->getId(),
            'image' => new ImageResource($this->getImage()),
            'name'  => $this->getName(),
            'link'  => $this->getLink(),
            'meta'  => [
                'title'       => $this->getMetaTitle(),
                'description' => $this->getMetaDescription(),
                'keywords'    => $this->getMetaKeywords(),
            ],
        ];
    }
}
