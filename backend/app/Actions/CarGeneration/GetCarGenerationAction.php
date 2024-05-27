<?php

namespace App\Actions\CarGeneration;

use App\Http\Resources\CarGeneration\CarGenerationResource;
use App\Repositories\CarGenerationRepository;
use Exception;

class GetCarGenerationAction
{

    public function __construct(
        private readonly CarGenerationRepository $carGenerationRepository,
    ) {}

    /**
     * @throws Exception
     */
    public function execute(?int $id = null, ?string $link = null): CarGenerationResource
    {
        $generationWith = [
            'model.brand',
            'images',
            'modifications.specs',
            'modifications.equipments',
            'modifications.image',
        ];

        if ($id !== null) {
            $generation = $this->carGenerationRepository->findById($id, $generationWith);
        } else if ($link !== null) {
            $generation = $this->carGenerationRepository->findByLink($link, $generationWith);
        } else {
            throw new Exception('Ошибка получения поколения машины');
        }

        if ($generation === null) {
            throw new Exception('Поколение машины не найдено');
        }

        return new CarGenerationResource($generation);
    }

}
