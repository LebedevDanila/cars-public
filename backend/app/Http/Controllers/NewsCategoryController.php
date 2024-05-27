<?php

namespace App\Http\Controllers;


use App\Http\Requests\NewCategory\GetNewsCategoryRequest;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use App\Repositories\NewsCategoryRepository;

class NewsCategoryController extends Controller
{

    public function get(
        GetNewsCategoryRequest $request,
        NewsCategoryRepository $newsCategoryRepository
    ): Success|Error
    {
        $newsCategory = $request->has('id')
            ? $newsCategoryRepository->findById($request->input('id'))
            : $newsCategoryRepository->findByLink($request->input('link'));

        if ($newsCategory === null) {
            return new Error('Такой категории новостей не существует');
        }

        return new Success($newsCategory);
    }

}
