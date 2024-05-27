<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarEquipment extends Model
{
    use HasFactory;

    protected $table = 'cars_equipments';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
    ];

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

}
