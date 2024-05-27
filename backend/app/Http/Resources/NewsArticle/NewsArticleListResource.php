<?php

namespace App\Http\Resources\NewsArticle;

use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\NewsCategory\NewsCategoryRelationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsArticleListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->getId(),
            'category'   => new NewsCategoryRelationResource($this->whenLoaded('category')),
            'image'      => new ImageResource($this->whenLoaded('image')),
            'name'       => $this->getName(),
            'link'       => $this->getLink(),
            'views'      => $this->getViews(),
            'tags'       => $this->getTags(),
            'created_at' => $this->getCreatedAt(),
        ];
    }
}
