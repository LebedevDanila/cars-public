<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSpecEntity extends Model
{
    use HasFactory;

    protected $table = 'cars_specs_entities';

    public $timestamps = false;

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getSpecId(): ?int
    {
        return $this->attributes['spec_id'] ?? null;
    }

    public function getCode(): ?string
    {
        return $this->attributes['code'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->attributes['name'] ?? null;
    }

    public function getModificationValue(): ?string
    {
        return $this->attributes['modification_value'] ?? null;
    }

    public function getSpecCode(): ?string
    {
        return $this->attributes['spec_code'] ?? null;
    }

    public function getSpecName(): ?string
    {
        return $this->attributes['spec_name'] ?? null;
    }

}
