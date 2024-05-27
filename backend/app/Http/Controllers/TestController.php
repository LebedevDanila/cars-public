<?php

namespace App\Http\Controllers;

use App\Actions\CarGeneration\GetCarGenerationAction;
use App\Actions\Catalog\PaginateListCatalogAction;
use App\Enums\CarGeneration\CarGenerationTypeEnum;
use App\Libs\Cdn;
use App\Libs\Response\Success;
use App\Models\Brand;
use App\Models\Car\CarGeneration;
use App\Models\Car\CarModel;
use App\Repositories\BrandRepository;
use App\Repositories\CarGenerationRepository;
use DB;
use Storage;

class TestController extends Controller
{

    public function run(
        PaginateListCatalogAction $paginateListCatalogAction,
    )
    {
        DB::connection()->enableQueryLog();

        $t = CarGeneration::with(['images'])->first();
        dd($t->images()->sync(['01HWTBC1DYG2G8CABAX6TKBTTM', '01HWTBC1G03MJNRD0ETCKM7WF4']));

        echo json_encode($queries = DB::getQueryLog());
    }

}
