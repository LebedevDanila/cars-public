<?php

namespace App\Actions\Brand;

use App\Http\Resources\Brand\BrandListResource;
use App\Models\Brand;

class PaginateListBrandAction
{
    public function __construct() {}

    public function execute(int $page = 1, int $limit = 10, string $orderBy = 'asc'): array
    {
        $paginate = Brand::with('image')
            ->orderBy('id', $orderBy)
            ->paginate(perPage: $limit, page: $page)
        ;

        return [
            'items' => BrandListResource::collection($paginate->items()),
            'page' => $paginate->currentPage(),
            'per_page' => $paginate->perPage(),
            'last_page' => $paginate->lastPage(),
            'total' => $paginate->total(),
        ];
    }

}
