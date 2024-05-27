<?php

namespace App\Actions\CarGeneration;

use App\Models\Car\CarGeneration;
use App\Models\Image\ImageRelation;
use App\Repositories\CarGenerationRepository;
use Illuminate\Support\Str;

class UpsertCarGenerationAction
{
    public function __construct(
        private readonly CarGenerationRepository $carGenerationRepository,
    ) {}

    public function execute(array $data = []): CarGeneration
    {
        if (isset($data['id'])) {
            $generation = $this->carGenerationRepository->findById($data['id']);
        } else {
            $generation = new CarGeneration();
        }

        if (isset($data['model_id'])) {
            $generation->setModelId($data['model_id']);
        }
        if (isset($data['name'])) {
            $generation->setName($data['name']);
        }
        if (isset($data['link'])) {
            $generation->setLink($data['link']);
        }
        if(!isset($data['link']) && isset($data['name'])) {
            $generation->setLink(Str::slug($data['name']));
        }
        if (isset($data['type'])) {
            $generation->setType($data['type']);
        }
        if (isset($data['other_names'])) {
            $generation->setOtherNames($data['other_names']);
        }
        if (isset($data['price_text_ru'])) {
            $generation->setPriceTextRu($data['price_text_ru']);
        }
        if (isset($data['price_text_cn'])) {
            $generation->setPriceTextCn($data['price_text_cn']);
        }
        if (isset($data['meta_title'])) {
            $generation->setMetaTitle($data['meta_title']);
        }
        if (isset($data['meta_description'])) {
            $generation->setMetaDescription($data['meta_description']);
        }
        if (isset($data['meta_keywords'])) {
            $generation->setMetaKeywords($data['meta_keywords']);
        }

        $this->carGenerationRepository->save($generation);

        if (!empty($data['images_ids'])) {
            $generation->images()->sync($data['images_ids']);
        }

        return $generation;
    }

}
