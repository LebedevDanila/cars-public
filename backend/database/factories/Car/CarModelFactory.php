<?php

namespace Database\Factories\Car;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarModelFactory extends Factory
{

    public function definition()
    {
        $name = fake()->words(fake()->numberBetween(1, 2), true);
        return [
            'brand_id' => 1,
            'name'     => $name,
            'link'     => Str::slug($name),
        ];
    }

}
