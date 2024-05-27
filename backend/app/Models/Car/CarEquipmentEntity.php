<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarEquipmentEntity extends Model
{
    use HasFactory;

    protected $table = 'cars_equipments_entities';

    public $timestamps = false;

    protected $fillable = [
        'equipment_id',
        'code',
        'name',
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getEquipmentId(): ?int
    {
        return $this->attributes['equipment_id'] ?? null;
    }

    public function getCode(): ?string
    {
        return $this->attributes['code'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->attributes['name'] ?? null;
    }

    public function getEquipmentCode(): ?string
    {
        return $this->attributes['equipment_code'] ?? null;
    }

    public function getEquipmentName(): ?string
    {
        return $this->attributes['equipment_name'] ?? null;
    }

}
