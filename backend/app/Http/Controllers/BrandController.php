<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\GetBrandRequest;
use App\Http\Resources\Brand\BrandResource;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use App\Repositories\BrandRepository;

class BrandController extends Controller
{

    public function get(
        GetBrandRequest $request,
        BrandRepository $brandRepository
    ): Success|Error
    {
        $brand = $request->has('id')
            ? $brandRepository->findById($request->input('id'))
            : $brandRepository->findByLink($request->input('link'));

        if ($brand === null) {
            return new Error('Такого бренда не существует');
        }

        return new Success(
            new BrandResource($brand)
        );
    }

}
