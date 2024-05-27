<?php

namespace App\Actions\CarGeneration;

use App\Http\Resources\CarGeneration\CarGenerationListResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\CarGenerationRepository;
use Exception;

class GetListCarGenerationAction
{

    public function __construct(
        private readonly CarGenerationRepository $carGenerationRepository,
    ) {}

    public function execute(?int $brandId = null, ?int $limit = null): ResourceCollection
    {
        $generations = $this->carGenerationRepository
            ->getList(['brandId' => $brandId], [
                'model.brand',
                'images',
                'modifications.specs' => function ($q) {
                    $q->whereIn('cars_specs_entities.code', ['engine_type', 'country', 'tank_volume']);
                },
                'modifications.image',
            ], $limit);

        return CarGenerationListResource::collection($generations);
    }

}
