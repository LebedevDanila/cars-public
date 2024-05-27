<?php

namespace App\Repositories;

use App\Models\Car\CarEquipment;
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Support\Str;

class CarEquipmentRepository
{

    /**
     * @throws Exception
     */
    public function findByCodeOrFail(string $code): CarEquipment|Exception
    {
        $equipment = CarEquipment::query()->where('code', $code)->first();
        if ($equipment === null) {
            throw new Exception('NotFound Equipment Code: ' . $code);
        }
        return $equipment;
    }

    public function save(string $name): CarEquipment
    {
        $name = trim(mb_strtolower($name));

        $equipment = new CarEquipment();
        $equipment->code = Str::slug($name);
        $equipment->name = $name;
        $equipment->save();

        return $equipment;
    }

    public function getAll(): Collection
    {
        return CarEquipment::all();
    }

}
