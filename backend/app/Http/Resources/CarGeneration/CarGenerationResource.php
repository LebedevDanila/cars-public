<?php

namespace App\Http\Resources\CarGeneration;

use App\Http\Resources\Brand\BrandRelationResource;
use App\Http\Resources\CarModel\CarModelRelationResource;
use App\Http\Resources\CarModification\CarModificationResource;
use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarGenerationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->getId(),
            'model'         => new CarModelRelationResource($this->getModel()),
            'brand'         => new BrandRelationResource($this->getModel()?->getBrand()),
            'images'        => ImageResource::collection($this->getImages()),
            'name'          => $this->getName(),
            'link'          => $this->getLink(),
            'type'          => $this->getType(),
            'other_names'   => $this->getOtherNames(),
            'price_text_ru' => $this->getPriceTextRu(),
            'price_text_cn' => $this->getPriceTextCn(),
            'meta'       => [
                'title'       => $this->getMetaTitle(),
                'description' => $this->getMetaDescription(),
                'keywords'    => $this->getMetaKeywords(),
            ],
            'modifications' => CarModificationResource::collection($this->getModifications())
        ];
    }
}
