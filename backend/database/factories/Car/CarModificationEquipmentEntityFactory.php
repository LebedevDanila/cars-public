<?php

namespace Database\Factories\Car;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarModificationEquipmentEntityFactory extends Factory
{

    public function definition()
    {
        return [
            'modification_id'     => 1,
            'equipment_entity_id' => 1
        ];
    }

}
