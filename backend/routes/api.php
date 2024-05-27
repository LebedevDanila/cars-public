<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\ImageController as AdminImageController;
use App\Http\Controllers\Admin\CarModelController as AdminCarModelController;
use App\Http\Controllers\Admin\CarGenerationController as AdminCarGenerationController;
use App\Http\Controllers\Admin\CarEquipmentController as AdminCarEquipmentController;
use App\Http\Controllers\NewsArticleController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\CarGenerationController;
use App\Http\Controllers\CarModelController;
use \App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/test', [\App\Http\Controllers\TestController::class, 'run']);

Route::prefix('common')->group(function () {
    Route::get('/static-data', [CommonController::class, 'getStaticData']);
    Route::post('/catalog', [CommonController::class, 'getCatalog']);
});


Route::prefix('brand')->group(function () {
    Route::get('/get', [BrandController::class, 'get']); // GET: id, link
});

Route::prefix('news')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/get', [NewsCategoryController::class, 'get']); // GET: id, link
    });

    Route::prefix('article')->group(function () {
        Route::get('/get', [NewsArticleController::class, 'get']); // GET: id, link
        Route::post('/list', [NewsArticleController::class, 'list']); // category_id = null | int
    });
});

Route::prefix('car')->group(function () {
    Route::prefix('model')->group(function () {
        Route::get('/get', [CarModelController::class, 'get']); // GET: id, link
        Route::get('/list', [CarModelController::class, 'list']); // GET: page = int, limit = null | int
    });

    Route::prefix('generation')->group(function () {
        Route::get('/get', [CarGenerationController::class, 'get']); // GET: id, link
        Route::post('/list', [CarGenerationController::class, 'list']); // brand_id = int
    });
});

Route::prefix('admin')->group(function () {
    Route::prefix('image')->group(function () {
        Route::post('/upload', [AdminImageController::class, 'upload']);
    });

    Route::prefix('brand')->group(function () {
        Route::get('/list', [AdminBrandController::class, 'list']);
        Route::post('/upsert', [AdminBrandController::class, 'upsert']);
        Route::post('/delete', [AdminBrandController::class, 'delete']);
    });

    Route::prefix('car')->group(function () {
        Route::prefix('model')->group(function () {
            Route::get('/list', [AdminCarModelController::class, 'list']);
            Route::post('/upsert', [AdminCarModelController::class, 'upsert']);
            Route::post('/delete', [AdminCarModelController::class, 'delete']);
        });

        Route::prefix('generation')->group(function () {
            Route::get('/list', [AdminCarGenerationController::class, 'list']);
            Route::post('/upsert', [AdminCarGenerationController::class, 'upsert']);
            Route::post('/delete', [AdminCarGenerationController::class, 'delete']);
        });

        Route::prefix('equipment')->group(function () {
            Route::get('/list', [AdminCarEquipmentController::class, 'list']);
            Route::post('/create', [AdminCarEquipmentController::class, 'create']);

            Route::prefix('entity')->group(function () {
                Route::get('/list', [AdminCarEquipmentController::class, 'entitiesList']);
                Route::post('/create', [AdminCarEquipmentController::class, 'createModificationEntity']);
            });
        });
    });
});
