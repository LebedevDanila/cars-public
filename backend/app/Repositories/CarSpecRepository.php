<?php

namespace App\Repositories;

use App\Models\Car\CarSpec;
use Illuminate\Database\Eloquent\Collection;

class CarSpecRepository
{

    public function getList(array $with = []): Collection
    {
        return CarSpec::query()
            ->with($with)
            ->get()
        ;
    }

}
