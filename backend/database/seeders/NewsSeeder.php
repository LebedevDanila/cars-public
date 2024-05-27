<?php

namespace database\seeders;


use App\Models\Image\Image;
use App\Models\Image\ImageRelation;
use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Статьи',
                'link' => 'articles'
            ],
            [
                'name' => 'Рейтинги',
                'link' => 'ratings'
            ],
            [
                'name' => 'Тест-драйв',
                'link' => 'test-drive'
            ],
            [
                'name' => 'Обзоры',
                'link' => 'reviews'
            ],
            [
                'name' => 'Сравнения',
                'link' => 'comparisons'
            ],
            [
                'name' => 'Документация',
                'link' => 'docs'
            ],
        ];
        $images = Image::query()->get()->toArray();

        foreach ($categories as $key => $category) {
            $data = NewsCategory::factory()
                ->create($category)
                ->toArray();

            $categories[$key] = array_merge($category, $data);
        }

        $articles = [];
        for ($i = 0; $i < 30; $i++) {
            $articles[] = NewsArticle::factory()->create([
                'category_id' => $categories[array_rand($categories)]['id']
            ]);
        }

        foreach ($articles as $article) {
            ImageRelation::factory()->create([
                'image_id'    => $images[array_rand($images)]['id'],
                'imageable_type' => NewsArticle::class,
                'imageable_id'   => $article['id'],
            ]);
        }

    }
}
