<?php

namespace App\Actions\Brand;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Support\Str;

class UpsertBrandAction
{
    public function __construct(
        private readonly BrandRepository $brandRepository,
    ) {}

    public function execute(array $data = []): Brand
    {
        if (isset($data['id'])) {
            $brand = $this->brandRepository->findById($data['id']);
        } else {
            $brand = new Brand();
        }

        if (isset($data['name'])) {
            $brand->setName($data['name']);
        }
        if (isset($data['link'])) {
            $brand->setLink($data['link']);
        }
        if(!isset($data['link']) && isset($data['name'])) {
            $brand->setLink(Str::slug($data['name']));
        }
        if (isset($data['text'])) {
            $brand->setText($data['text']);
        }
        if (isset($data['status'])) {
            $brand->setStatus($data['status']);
        }
        if (isset($data['meta_title'])) {
            $brand->setMetaTitle($data['meta_title']);
        }
        if (isset($data['meta_description'])) {
            $brand->setMetaDescription($data['meta_description']);
        }
        if (isset($data['meta_keywords'])) {
            $brand->setMetaKeywords($data['meta_keywords']);
        }

        $this->brandRepository->save($brand);

        if (isset($data['image_id'])) {
            if (is_null($brand->getImageRelation())) {
                $brand->imageRelation()->create([
                    'image_id'       => $data['image_id'],
                    'imageable_id'   => $brand->getId(),
                    'imageable_type' => Brand::class
                ]);
            } else {
                $brand->imageRelation()->update(['image_id' => $data['image_id']]);
            }
        }

        return $brand;
    }

}
