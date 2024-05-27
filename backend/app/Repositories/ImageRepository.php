<?php

namespace App\Repositories;

use App\Models\Image\Image;
use App\Models\Image\ImageRelation;

class ImageRepository
{

    public function findById(string $id): ?Image
    {
        return Image::find($id);
    }

    public function findByHash(string $hash): ?Image
    {
        return Image::where('hash', $hash)->first();
    }

    public function save(Image $entity): Image
    {
        $entity->save();
        return $entity;
    }

}
