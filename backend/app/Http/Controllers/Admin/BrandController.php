<?php

namespace App\Http\Controllers\Admin;


use App\Actions\Brand\UpsertBrandAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Brand\BrandResource;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function list(
        BrandRepository $brandRepository,
    ): Success|Error
    {
        $brands = $brandRepository->getAll();

        return new Success(
            BrandResource::collection($brands)
        );
    }

    public function delete(
        Request $request,
        BrandRepository $brandRepository,
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'id' => 'int|required',
        ]);

        $brand = $brandRepository->findById($validated['id']);
        if ($brand === null) {
            return new Error('Бренд не найден');
        }

        return new Success(
            $brandRepository->delete($brand)
        );
    }

    public function upsert(
        Request           $request,
        UpsertBrandAction $upsertBrandAction,
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'id' => 'int|nullable',
            'name' => 'string|max:255',
            'link' => 'string|max:255|nullable',
            'text' => 'string|nullable',
            'status' => 'boolean|nullable',
            'meta_title' => 'string|max:255|nullable',
            'meta_description' => 'string|max:255|nullable',
            'meta_keywords' => 'string|max:100|nullable',
            'image_id' => 'string|exists:images,id',
        ]);

        try {
            $brand = $upsertBrandAction->execute($validated);
        } catch (\Exception $e) {
            return new Error('Произошла ошибка');
        }

        return new Success(
            new BrandResource($brand)
        );
    }

}
