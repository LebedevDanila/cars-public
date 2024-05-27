<?php

namespace Database\Factories\Car;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarModificationSpecEntityFactory extends Factory
{

    public function definition()
    {
        $value = fake()->words(3, true);
        return [
            'value' => $value,
        ];
    }

}
