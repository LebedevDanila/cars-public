<?php

namespace Database\Factories\News;

use App\Models\News\NewsArticle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsArticleFactory extends Factory
{

    protected $model = NewsArticle::class;

    public function definition()
    {
        $name = fake()->unique()->words(fake()->numberBetween(3, 6), true);
        return [
            'name' => $name,
            'link' => Str::slug($name),
            'text' => fake()->paragraph(5),
            'views' => fake()->numberBetween(1, 999 ),
            'status' => 1,
            'tags' => fake()->shuffleArray(explode(' ', fake()->words(3, true))),
            'meta_title' => fake()->text(50),
            'meta_description' => fake()->text(150),
            'meta_keywords' => fake()->text(20),
        ];
    }

}
