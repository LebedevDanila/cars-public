<?php

namespace Database\Factories\Car;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarEquipmentFactory extends Factory
{
    public function definition()
    {
        $name = fake()->words(2, true);
        return [
            'code' => Str::slug($name),
            'name' => $name,
        ];
    }

}
