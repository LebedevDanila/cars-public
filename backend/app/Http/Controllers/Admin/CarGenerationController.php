<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CarGeneration\UpsertCarGenerationAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarGeneration\CarGenerationListResource;
use App\Http\Resources\CarGeneration\CarGenerationResource;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use App\Repositories\CarGenerationRepository;
use Illuminate\Http\Request;

class CarGenerationController extends Controller
{

    public function list(
        CarGenerationRepository $carGenerationRepository,
    ): Success|Error
    {
        $generations = $carGenerationRepository->getAll();

        return new Success(
            CarGenerationListResource::collection($generations)
        );
    }

    public function delete(
        Request $request,
        CarGenerationRepository $carGenerationRepository,
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'id' => 'int|required',
        ]);

        $generation = $carGenerationRepository->findById($validated['id']);
        if ($generation === null) {
            return new Error('Поколение не найдено');
        }

        return new Success(
            $carGenerationRepository->delete($generation)
        );
    }

    public function upsert(
        Request              $request,
        UpsertCarGenerationAction $upsertCarGenerationAction,
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'id' => 'int|nullable',
            'name' => 'string|max:255',
            'link' => 'string|max:255|nullable',
            'type' => 'string|max:255|nullable',
            'other_names' => 'string|max:255|nullable',
            'price_text_ru' => 'string|max:255|nullable',
            'price_text_cn' => 'string|max:255|nullable',
            'meta_title' => 'string|max:255|nullable',
            'meta_description' => 'string|max:255|nullable',
            'meta_keywords' => 'string|max:100|nullable',
            'images_ids' => 'string|exists:images,id',
        ]);

        try {
            $generation = $upsertCarGenerationAction->execute($validated);
        } catch (\Exception $e) {
            return new Error('Произошла ошибка');
        }

        return new Success(
            new CarGenerationResource($generation)
        );
    }

}
