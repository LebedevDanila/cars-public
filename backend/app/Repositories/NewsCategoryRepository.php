<?php

namespace App\Repositories;

use App\Models\News\NewsCategory;
use Illuminate\Database\Eloquent\Collection;

class NewsCategoryRepository
{

    public function findById(int $id): ?NewsCategory
    {
        return NewsCategory::find($id);
    }

    public function findByLink(string $link): ?NewsCategory
    {
        return NewsCategory::where('link', $link)->first();
    }

    public function getList(): Collection
    {
        return NewsCategory::query()
            ->select('id', 'name', 'link')
            ->get()
        ;
    }

}
