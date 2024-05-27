<?php

namespace App\Repositories;

use App\Models\News\NewsArticle;

class NewsArticleRepository
{

    public function findById(int $id): ?NewsArticle
    {
        return NewsArticle::where('id', $id)->with('category', 'image')->first();
    }

    public function findByLink(string $link): ?NewsArticle
    {
        return NewsArticle::where('link', $link)->with('category', 'image')->first();
    }

}
