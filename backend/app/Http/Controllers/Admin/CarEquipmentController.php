<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use App\Models\Car\CarModificationEquipmentEntity;
use App\Repositories\CarEquipmentEntityRepository;
use App\Repositories\CarEquipmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

class CarEquipmentController extends Controller
{

    public function list(
        CarEquipmentRepository $carEquipmentRepository
    ): Success|Error
    {
        return new Success(
            $carEquipmentRepository->getAll()
        );
    }

    public function create(
        Request $request,
        CarEquipmentRepository $carEquipmentRepository
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'name' => 'string|required',
        ]);

        $name = trim(mb_strtoupper($validated['name']));
        $code = Str::slug($name);

        try {
            $equipment = $carEquipmentRepository->findByCodeOrFail($code);
        } catch (Exception $e) {
            $equipment = $carEquipmentRepository->save($name);
        }

        return new Success($equipment);
    }

    public function entitiesList(
        Request $request,
        CarEquipmentEntityRepository $carEquipmentEntityRepository
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'equipment_id' => 'int|required',
        ]);

        return new Success(
            $carEquipmentEntityRepository->getListByEquipmentId($validated['equipment_id'])
        );
    }

    public function createModificationEntity(
        Request $request,
        CarEquipmentEntityRepository $carEquipmentEntityRepository
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'modification_id' => 'int|required',
            'equipment_id' => 'int|required',
            'name' => 'string|required',
        ]);

        $name = trim(mb_strtoupper($validated['name']));
        $code = Str::slug($name);

        try {
            $eqEntity = $carEquipmentEntityRepository->findByCodeOrFail($code);
        } catch (Exception $e) {
            $eqEntity = $carEquipmentEntityRepository->save($validated['equipment_id'], $name);
        }

        CarModificationEquipmentEntity::create([
            'modification_id' => $validated['modification_id'],
            'equipment_entity_id' => $eqEntity->getId(),
        ]);

        return new Success(true);
    }

}
