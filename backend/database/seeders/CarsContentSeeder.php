<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car\CarEquipmentEntity;
use App\Models\Car\CarGeneration;
use App\Models\Car\CarModel;
use App\Models\Car\CarModification;
use App\Models\Car\CarModificationEquipmentEntity;
use App\Models\Car\CarModificationSpecEntity;
use App\Models\Car\CarSpecEntity;
use App\Models\Image\Image;
use App\Models\Image\ImageRelation;
use DB;
use Illuminate\Database\Seeder;

class CarsContentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $brands = Brand::query()->get()->toArray();
        $specsEntities = CarSpecEntity::query()->get();
        $equipmentsEntities = CarEquipmentEntity::query()->get();
        $images = Image::query()->get()->toArray();

        for ($g = 0; $g < 5; $g++) {
            $model = CarModel::factory()->create([
                'brand_id' => $brands[array_rand($brands)]['id'],
            ]);

            ImageRelation::factory()->create([
                'image_id'       => $images[array_rand($images)]['id'],
                'imageable_id'   => $model->getId(),
                'imageable_type' => CarModel::class,
            ]);

            $generation = CarGeneration::factory()->create([
                'model_id'      => $model->getId(),
                'price_text_ru' => '2.000.000 руб.',
                'price_text_cn' => '124.900 - 159.900 юаней (1.414.000 - 1.810.000 руб.)',
            ]);

            for ($img = 0; $img < 4; $img++) {
                ImageRelation::factory()->create([
                    'image_id'       => $images[$img]['id'],
                    'imageable_id'   => $generation->getId(),
                    'imageable_type' => CarGeneration::class,
                ]);
            }

            for ($m = 0; $m < 5; $m++) {
                $modification = CarModification::factory()->create([
                    'generation_id' => $generation->getId(),
                ]);

                ImageRelation::factory()->create([
                    'image_id'      => $images[array_rand($images)]['id'],
                    'imageable_id'   => $modification->getId(),
                    'imageable_type' => CarModification::class,
                ]);

                foreach ($specsEntities as $specsEntity) {
                    CarModificationSpecEntity::factory()->create([
                        'modification_id' => $modification->getId(),
                        'spec_entity_id'  => $specsEntity->getId(),
                    ]);
                }

                $modificationEquipmentsEntities = [];
                foreach ($equipmentsEntities as $k => $equipmentsEntity) {
                    if ($k === 20) {
                        break;
                    }
                    $modificationEquipmentsEntities[] = [
                        'modification_id'     => $modification->getId(),
                        'equipment_entity_id' => $equipmentsEntity->getId(),
                    ];
                }
                $w = 0;
                while ($w < 10) {
                    unset($modificationEquipmentsEntities[mt_rand(0 , count($modificationEquipmentsEntities))]);
                    $w++;
                }
                foreach ($modificationEquipmentsEntities as $modificationEquipmentsEntity) {
                    CarModificationEquipmentEntity::factory()->create([
                        'modification_id'      => $modificationEquipmentsEntity['modification_id'],
                        'equipment_entity_id'  => $modificationEquipmentsEntity['equipment_entity_id'],
                    ]);
                }
            }
        }
    }
}
