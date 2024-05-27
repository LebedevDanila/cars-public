<?php

namespace Database\Factories\News;

use App\Models\News\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsCategoryFactory extends Factory
{

    protected $model = NewsCategory::class;


    public function definition()
    {
        return [
            'name' => fake()->text(5),
            'link' => fake()->text(22),
            'meta_title' => fake()->text(50),
            'meta_description' => fake()->text(150),
            'meta_keywords' => fake()->text(20),
        ];
    }

}
