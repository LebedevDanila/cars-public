<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{

    public function definition()
    {
        $name = fake()->words(fake()->numberBetween(1, 2), true);
        return [
            'name' => $name,
            'link' => Str::slug($name),
            'text' => fake()->paragraph(5),
            'meta_title' => fake()->text(50),
            'meta_description' => fake()->text(150),
            'meta_keywords' => fake()->text(20),
        ];
    }

}
