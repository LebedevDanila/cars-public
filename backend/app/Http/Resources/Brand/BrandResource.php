<?php

namespace App\Http\Resources\Brand;

use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->getId(),
            'image' => new ImageResource($this->getImage()),
            'name'  => $this->getName(),
            'link'  => $this->getLink(),
            'text'  => $this->getText(),
            'status' => $this->getStatus(),
            'meta'  => [
                'title'       => $this->getMetaTitle(),
                'description' => $this->getMetaDescription(),
                'keywords'    => $this->getMetaKeywords(),
            ],
        ];
    }
}
