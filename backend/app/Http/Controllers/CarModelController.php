<?php

namespace App\Http\Controllers;

use App\Actions\CarModel\PaginateListCarModelAction;
use App\Http\Requests\CarModel\GetCarModelRequest;
use App\Http\Requests\CarModel\ListCarModelRequest;
use App\Http\Resources\CarModel\CarModelResource;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use App\Repositories\CarModelRepository;

class CarModelController extends Controller
{
    public function list(
        ListCarModelRequest $request,
        PaginateListCarModelAction $paginateListCarModelAction
    ): Success|Error
    {
        return new Success(
            $paginateListCarModelAction->execute(
                $request->input('page') ?? 1,
                $request->input('limit') ?? null,
            )
        );
    }

    public function get(
        GetCarModelRequest $request,
        CarModelRepository $carModelRepository
    ): Success|Error
    {
        $model = $request->has('id')
            ? $carModelRepository->findById($request->input('id'))
            : $carModelRepository->findByLink($request->input('link'));

        if ($model === null) {
            return new Error('Такой модели не существует');
        }

        return new Success(
            new CarModelResource($model)
        );
    }

}
