<?php

namespace App\Http\Controllers;


use App\Actions\Brand\PaginateListBrandAction;
use App\Actions\Catalog\PaginateListCatalogAction;
use App\Enums\CarGeneration\CarGenerationTypeEnum;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use App\Repositories\NewsCategoryRepository;
use Cache;
use Illuminate\Http\Request;

class CommonController extends Controller
{

    public function getStaticData(
        NewsCategoryRepository $newsCategoryRepository,
        PaginateListBrandAction $paginateListBrandAction,
    ): Success|Error
    {
        $cache = Cache::remember('common-static-data', 180, function () use ($newsCategoryRepository, $paginateListBrandAction) {
            $newsCategories = $newsCategoryRepository->getList();
            $brands = $paginateListBrandAction->execute(1, 10, 'desc');

            $menuPages = array_merge(
                array_map(fn ($category) => [
                    'id'   => $category['id'],
                    'name' => $category['name'],
                    'link' => '/news/category/'.$category['link']
                ], $newsCategories->toArray()),
                [
                    ['name' => 'F&Q', 'link' => '/faq']
                ],
            );

            return [
                'menu' => $menuPages,
                'brands' => $brands['items'],
                'enums' => [
                    'generation_types' => CarGenerationTypeEnum::localized(),
                ]
            ];
        });

        return new Success($cache);
    }

    public function getCatalog(
        Request $request,
        PaginateListCatalogAction $paginateListCatalogAction,
    ): Success|Error
    {
        $validated = $this->validate($request, [
            'page' => 'required|integer',
        ]);

        $page = $validated['page'];
        $cacheKey = 'catalog-page-'.$page;

        $cache = Cache::remember($cacheKey, 180, function () use ($page, $paginateListCatalogAction) {
            return $paginateListCatalogAction->execute($page);
        });

        return new Success($cache);
    }

}
