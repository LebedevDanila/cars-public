<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Collection;

class BrandRepository
{

    public function findById(int $id): ?Brand
    {
        return Brand::find($id);
    }

    public function findByLink(string $link): ?Brand
    {
        return Brand::where('link', $link)->first();
    }

    public function getAll(): Collection
    {
        return Brand::all();
    }

    public function save(Brand $brandModel): Brand
    {
        $brandModel->save();
        return $brandModel;
    }

    public function delete(Brand $entity): bool
    {
        return $entity->delete();
    }

}
