<?php

namespace App\Repositories;

use App\Models\Car\CarGeneration;
use Illuminate\Support\Collection;

class CarGenerationRepository
{

    public function findById(int $id, array $with = []): ?CarGeneration
    {
        return CarGeneration::where('id', $id)
            ->with($with)
            ->first()
        ;
    }

    public function findByLink(string $link, array $with = []): ?CarGeneration
    {
        return CarGeneration::where('link', $link)
            ->with($with)
            ->first()
        ;
    }

    public function getList(array $choice = [], array $with = [], ?int $limit = null): Collection
    {
        $query = CarGeneration::query()->with($with);

        if (isset($choice['brandId'])) {
            $query = $this->filterByBrandId($query, $choice['brandId']);
        }

        if (isset($choice['brandsIds'])) {
            $query = $this->filterByBrandsIds($query, $choice['brandsIds']);
        }

        if (isset($choice['modelId'])) {
            $query = $this->filterByModelId($query, $choice['modelId']);
        }

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->get();
    }

    private function filterByBrandId($query, $brandId)
    {
        return $query->whereHas('model', function ($query) use ($brandId) {
            $query->where('id', $brandId);
        });
    }

    private function filterByBrandsIds($query, $brandsIds)
    {
        return $query->whereHas('model.brand', function ($query) use ($brandsIds) {
            $query->whereIn('id', $brandsIds);
        });
    }

    private function filterByModelId($query, $modelId)
    {
        return $query->whereHas('model.brand', function ($query) use ($modelId) {
            $query->where('id', $modelId);
        });
    }

    public function getAll(): Collection
    {
        return CarGeneration::all();
    }

    public function save(CarGeneration $entity): CarGeneration
    {
        $entity->save();
        return $entity;
    }

    public function delete(CarGeneration $entity): bool
    {
        return $entity->delete();
    }

}
