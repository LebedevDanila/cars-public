<?php

namespace App\Actions\CarModel;

use App\Models\Car\CarModel;
use App\Repositories\CarModelRepository;
use Illuminate\Support\Str;

class UpsertCarModelAction
{
    public function __construct(
        private readonly CarModelRepository $carModelRepository,
    ) {}

    public function execute(array $data = []): CarModel
    {
        if (isset($data['id'])) {
            $model = $this->carModelRepository->findById($data['id']);
        } else {
            $model = new CarModel();
        }

        if (isset($data['name'])) {
            $model->setName($data['name']);
        }
        if (isset($data['link'])) {
            $model->setLink($data['link']);
        }
        if(!isset($data['link']) && isset($data['name'])) {
            $model->setLink(Str::slug($data['name']));
        }
        if (isset($data['meta_title'])) {
            $model->setMetaTitle($data['meta_title']);
        }
        if (isset($data['meta_description'])) {
            $model->setMetaDescription($data['meta_description']);
        }
        if (isset($data['meta_keywords'])) {
            $model->setMetaKeywords($data['meta_keywords']);
        }

        $this->carModelRepository->save($model);

        if (isset($data['image_id'])) {
            if (is_null($model->getImageRelation())) {
                $model->imageRelation()->create([
                    'image_id'       => $data['image_id'],
                    'imageable_id'   => $model->getId(),
                    'imageable_type' => CarModel::class
                ]);
            } else {
                $model->imageRelation()->update(['image_id' => $data['image_id']]);
            }
        }

        return $model;
    }

}
