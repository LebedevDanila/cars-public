<?php

namespace App\Http\Resources\CarGeneration;

use App\Http\Resources\Brand\BrandRelationResource;
use App\Http\Resources\CarModification\CarModificationResource;
use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarGenerationListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->getId(),
            'brand'          => $this->whenLoaded('model.brand') ? new BrandRelationResource($this->model?->brand) : null,
            'images'         => ImageResource::collection($this->whenLoaded('images')),
            'name'           => $this->getName(),
            'link'           => $this->getLink(),
            'type'           => $this->getType(),
            'other_names'    => $this->getOtherNames(),
            'price_text_ru'  => $this->getPriceTextRu(),
            'price_text_cn'  => $this->getPriceTextCn(),
            'specs_entities' => $this->getModificationsMainSpecsEntities(),
        ];
    }
}
