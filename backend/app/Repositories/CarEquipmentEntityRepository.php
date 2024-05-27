<?php

namespace App\Repositories;

use App\Models\Car\CarEquipmentEntity;
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Support\Str;

class CarEquipmentEntityRepository
{

    /**
     * @throws Exception
     */
    public function findByCodeOrFail(string $code): CarEquipmentEntity|Exception
    {
        $eqEntity = CarEquipmentEntity::query()->where('code', $code)->first();
        if ($eqEntity === null) {
            throw new Exception('NotFound Equipment Entity Code: ' . $code);
        }
        return $eqEntity;
    }

    public function save(int $equipmentId, string $name): CarEquipmentEntity
    {
        $name = trim(mb_strtolower($name));

        $eqEntity = new CarEquipmentEntity();
        $eqEntity->equipment_id = $equipmentId;
        $eqEntity->code = Str::slug($name);
        $eqEntity->name = $name;
        $eqEntity->save();

        return $eqEntity;
    }

    public function getListByEquipmentId(int $equipmentId): Collection
    {
        return CarEquipmentEntity::query()->where('equipment_id', $equipmentId)->get();
    }

}
