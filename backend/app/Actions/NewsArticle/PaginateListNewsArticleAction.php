<?php

namespace App\Actions\NewsArticle;

use App\Http\Resources\NewsArticle\NewsArticleListResource;
use App\Models\News\NewsArticle;

class PaginateListNewsArticleAction
{

    public function __construct() {}

    public function execute(?int $categoryId = null, int $page = 1, ?int $limit = 10): array
    {
        $paginate = NewsArticle::with(['category', 'image'])
            ->when($categoryId, function ($query, $categoryId) {
                return $query->whereHas('category', function ($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                });
            })
            ->paginate(perPage: $limit, page: $page)
        ;

        return [
            'items' => NewsArticleListResource::collection($paginate->items()),
            'page' => $paginate->currentPage(),
            'per_page' => $paginate->perPage(),
            'last_page' => $paginate->lastPage(),
            'total' => $paginate->total(),
        ];
    }

}
