<?php

namespace Database\Factories\Car;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarEquipmentEntityFactory extends Factory
{

    public function definition()
    {
        $name = fake()->words(1, true);
        return [
            'code' => Str::slug($name),
            'name' => $name,
        ];
    }

}
