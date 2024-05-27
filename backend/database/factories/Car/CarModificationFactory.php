<?php

namespace Database\Factories\Car;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarModificationFactory extends Factory
{

    public function definition()
    {
        $name = fake()->words(fake()->numberBetween(1, 3), true);
        return [
            'generation_id' => 1,
            'name'          => $name,
        ];
    }

}
