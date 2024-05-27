<?php

namespace App\Actions\CarModel;

use App\Http\Resources\CarGeneration\CarGenerationListResource;
use App\Http\Resources\CarModel\CarModelListResource;
use App\Models\Car\CarModel;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\CarGenerationRepository;
use Exception;

class PaginateListCarModelAction
{

    public function __construct() {}

    public function execute(int $page = 1, ?int $limit = 10): array
    {
        $paginate = CarModel::with(['brand', 'image'])
            ->paginate(perPage: $limit, page: $page)
        ;

        return [
            'items' => CarModelListResource::collection($paginate->items()),
            'page' => $paginate->currentPage(),
            'per_page' => $paginate->perPage(),
            'last_page' => $paginate->lastPage(),
            'total' => $paginate->total(),
        ];
    }

}
