<?php

namespace App\Repositories;

use App\Models\Car\CarModel;
use Illuminate\Support\Collection;

class CarModelRepository
{

    public function findById(int $id, array $with = []): ?CarModel
    {
        return CarModel::where('id', $id)
            ->with($with)
            ->first()
        ;
    }

    public function findByLink(string $link, array $with = []): ?CarModel
    {
        return CarModel::where('link', $link)
            ->with($with)
            ->first()
        ;
    }

    public function getAll(): Collection
    {
        return CarModel::all();
    }

    public function save(CarModel $entity): CarModel
    {
        $entity->save();
        return $entity;
    }

    public function delete(CarModel $entity): bool
    {
        return $entity->delete();
    }

}
