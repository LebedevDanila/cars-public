<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModificationSpecEntity extends Model
{
    use HasFactory;

    protected $table = 'cars_modification_spec_entity';

    public $timestamps = false;

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getModificationId(): ?int
    {
        return $this->attributes['modification_id'] ?? null;
    }

    public function getSpecEntityId(): ?int
    {
        return $this->attributes['spec_entity_id'] ?? null;
    }

    public function getValue(): ?string
    {
        return $this->attributes['value'] ?? null;
    }

    public function entity()
    {
        return $this->belongsTo(CarSpecEntity::class, 'spec_entity_id', 'id');
    }

    public function getEntity()
    {
        return $this->entity;
    }

}
