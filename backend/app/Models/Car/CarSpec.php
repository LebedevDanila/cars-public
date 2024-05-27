<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSpec extends Model
{
    use HasFactory;

    protected $table = 'cars_specs';

    public $timestamps = false;

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getCode(): ?string
    {
        return $this->attributes['code'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->attributes['name'] ?? null;
    }

    public function entities()
    {
        return $this->hasMany(CarSpecEntity::class, 'spec_id', 'id');
    }

}
