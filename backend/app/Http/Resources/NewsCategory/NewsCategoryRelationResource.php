<?php

namespace App\Http\Resources\NewsCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsCategoryRelationResource extends JsonResource
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
