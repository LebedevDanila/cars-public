<?php

namespace App\Models\Car;

use App\Models\Image\Image;
use App\Models\Image\ImageRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModification extends Model
{
    use HasFactory;

    protected $table = 'cars_modifications';

    public $timestamps = false;

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getGenerationId(): ?int
    {
        return $this->attributes['generation_id'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->attributes['name'] ?? null;
    }

    public function specs()
    {
        return $this->belongsToMany(
            CarSpecEntity::class,
            'cars_modification_spec_entity',
                'modification_id',
            'spec_entity_id',
        )->select(
            'cars_specs_entities.id',
            'cars_specs_entities.spec_id',
            'cars_specs.name as spec_name',
            'cars_specs.code as spec_code',
            'cars_specs_entities.code',
            'cars_specs_entities.name',
            'cars_modification_spec_entity.value as modification_value'
        )->leftJoin(
            'cars_specs',
            'cars_specs.id', '=', 'cars_specs_entities.spec_id'
        );
    }

    public function getSpecs()
    {
        return $this->specs;
    }

    public function getGroupedSpecs(): array
    {
        $specsInfo = [];
        foreach ($this->getSpecs() as $specsEntity) {
            $specId = $specsEntity->getSpecId();

            if (!isset($specsInfo[$specId])) {
                $specsInfo[$specId] = [
                    'id'   => $specId,
                    'code' => $specsEntity->getSpecCode(),
                    'name' => $specsEntity->getSpecName(),
                ];
            }

            $specsInfo[$specId]['entities'][] = [
                'name'  => $specsEntity->getName(),
                'code'  => $specsEntity->getCode(),
                'value' => $specsEntity->getModificationValue()
            ];
        }
        return array_values($specsInfo);
    }

    public function equipments()
    {
        return $this->belongsToMany(
            CarEquipmentEntity::class,
            'cars_modification_equipment_entity',
            'modification_id',
            'equipment_entity_id',
        )->select(
            'cars_equipments_entities.id',
            'cars_equipments_entities.equipment_id',
            'cars_equipments.name as equipment_name',
            'cars_equipments.code as equipment_code',
            'cars_equipments_entities.code',
            'cars_equipments_entities.name',
        )->leftJoin(
            'cars_equipments',
            'cars_equipments.id', '=', 'cars_equipments_entities.equipment_id'
        );
    }

    public function getEquipments()
    {
        return $this->equipments;
    }

    public function getGroupedEquipments(): array
    {
        $equipmentsInfo = [];
        foreach ($this->getEquipments() as $equipmentsEntity) {
            $equipmentId = $equipmentsEntity->getEquipmentId();

            if (!isset($equipmentsInfo[$equipmentId])) {
                $equipmentsInfo[$equipmentId] = [
                    'id'   => $equipmentId,
                    'code' => $equipmentsEntity->getEquipmentCode(),
                    'name' => $equipmentsEntity->getEquipmentName(),
                ];
            }

            $equipmentsInfo[$equipmentId]['entities'][] = [
                'id'   => $equipmentsEntity->getId(),
                'code' => $equipmentsEntity->getCode(),
                'name' => $equipmentsEntity->getName(),
            ];
        }
        return array_values($equipmentsInfo);
    }

    public function image()
    {
        return $this->hasOneThrough(
            Image::class,
            ImageRelation::class,
            'imageable_id',
            'id',
            'id',
            'image_id'
        )->where('imageable_type', self::class);
    }

    public function getImage()
    {
        return $this->image;
    }

}
