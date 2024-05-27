<?php

namespace Database\Factories\Car;

use App\Enums\CarGeneration\CarGenerationTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarGenerationFactory extends Factory
{

    public function definition()
    {
        $name = fake()->words(fake()->numberBetween(1, 2), true);
        $types = CarGenerationTypeEnum::values();
        return [
            'model_id'      => 1,
            'name'          => $name,
            'link'          => Str::slug($name),
            'type'          => $types[array_rand($types)],
            'other_names'   => fake()->words(3, true),
            'price_text_ru' => fake()->words(1, true),
            'price_text_cn' => fake()->words(2, true),
        ];
    }

}
