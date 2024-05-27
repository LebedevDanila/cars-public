<?php

namespace App\Actions\Catalog;

use App\Actions\Brand\PaginateListBrandAction;
use App\Enums\CarGeneration\CarGenerationTypeEnum;
use App\Http\Resources\Image\ImageResource;
use App\Repositories\CarGenerationRepository;

class PaginateListCatalogAction
{

    public function __construct(
        private readonly PaginateListBrandAction $paginateListBrandAction,
        private readonly CarGenerationRepository $carGenerationRepository,
    ) {}

    public function execute(int $page = 1, int $limit = 6): array
    {
        $brands = $this->paginateListBrandAction->execute($page, $limit);
        $brandsIds = $brands['items']->map(fn ($row) => $row->getId())->toArray();
        $generations = $this->carGenerationRepository->getList(['brandsIds' => $brandsIds], ['model.brand']);
        $types = CarGenerationTypeEnum::localized();

        $catalog = [];
        foreach ($brands['items'] as $brand) {
            $catalog[$brand->getId()] = [
                'id'    => $brand->getId(),
                'image' => new ImageResource($brand->getImage()),
                'name'  => $brand->getName(),
                'link'  => $brand->getLink()
            ];
        }
        foreach ($generations as $generation) {
            $catalog[$generation->getModel()->getBrandId()]['types'][$generation->getType()]['enum'] = $generation->getType();
            $catalog[$generation->getModel()->getBrandId()]['types'][$generation->getType()]['name'] = $types[$generation->getType()];
            $catalog[$generation->getModel()->getBrandId()]['types'][$generation->getType()]['generations'][] = [
                'name' => $generation->getName(),
                'link' => $generation->getLink(),
            ];
        }
        foreach ($catalog as $key => $row) {
            if (isset($row['types'])) {
                $catalog[$key]['types'] = array_values($row['types']);
            }
        }

        return [
            'items' => array_values($catalog),
            'page' => $brands['page'],
            'per_page' => $brands['per_page'],
            'last_page' => $brands['last_page'],
            'total' => $brands['total'],
        ];
    }

}
