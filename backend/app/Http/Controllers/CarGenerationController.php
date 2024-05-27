<?php

namespace App\Http\Controllers;

use App\Actions\CarGeneration\GetCarGenerationAction;
use App\Actions\CarGeneration\GetListCarGenerationAction;
use App\Http\Requests\CarGeneration\GetCarGenerationRequest;
use App\Http\Requests\CarGeneration\ListCarGenerationRequest;
use App\Libs\Response\Error;
use App\Libs\Response\Success;

class CarGenerationController extends Controller
{

    public function get(
        GetCarGenerationRequest $request,
        GetCarGenerationAction $getCarGenerationAction
    ): Success|Error
    {
        try {
            $generation = $getCarGenerationAction->execute(
                id: $request->input('id'),
                link: $request->input('link')
            );
        } catch (\Exception $e) {
            return new Error($e->getMessage());
        }

        return new Success($generation);
    }

    public function list(
        ListCarGenerationRequest $request,
        GetListCarGenerationAction $getListCarGenerationAction
    ): Success|Error
    {
        return new Success(
            $getListCarGenerationAction->execute(
                brandId: $request->input('brand_id'),
                limit: $request->input('limit') ?? null,
            )
        );
    }

}
