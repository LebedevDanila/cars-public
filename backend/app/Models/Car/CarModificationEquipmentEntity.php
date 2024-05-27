<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModificationEquipmentEntity extends Model
{
    use HasFactory;

    protected $table = 'cars_modification_equipment_entity';

    public $timestamps = false;

    protected $fillable = [
        'modification_id',
        'equipment_entity_id',
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getModificationId(): ?int
    {
        return $this->attributes['modification_id'] ?? null;
    }

    public function getEquipmentEntityId(): ?int
    {
        return $this->attributes['equipment_entity_id'] ?? null;
    }

}
