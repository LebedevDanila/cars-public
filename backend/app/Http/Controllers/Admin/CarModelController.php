<?php

namespace App\Http\Controllers\Admin;


use App\Actions\CarModel\UpsertCarModelAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarModel\CarModelListResource;
use App\Http\Resources\CarModel\CarModelResource;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use App\Repositories\CarModelRepository;
use Illuminate\Http\Request;

class CarModelController extends Controller
{

    public function list(
        CarModelRepository $carModelRepository,
    ): Success|Error
    {
        $models = $carModelRepository->getAll();

        return new Success(
            CarModelListResource::collection($models)
        );
    }

    public function delete(
        Request $request,
        CarModelRepository $carModelRepository,
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'id' => 'int|required',
        ]);

        $model = $carModelRepository->findById($validated['id']);
        if ($model === null) {
            return new Error('Модель не найдена');
        }

        return new Success(
            $carModelRepository->delete($model)
        );
    }

    public function upsert(
        Request              $request,
        UpsertCarModelAction $upsertCarModelAction,
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'id' => 'int|nullable',
            'name' => 'string|max:255',
            'link' => 'string|max:255|nullable',
            'meta_title' => 'string|max:255|nullable',
            'meta_description' => 'string|max:255|nullable',
            'meta_keywords' => 'string|max:100|nullable',
            'image_id' => 'string|exists:images,id',
        ]);

        try {
            $model = $upsertCarModelAction->execute($validated);
        } catch (\Exception $e) {
            return new Error('Произошла ошибка');
        }

        return new Success(
            new CarModelResource($model)
        );
    }

}
