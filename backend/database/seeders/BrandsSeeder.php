<?php

namespace Database\Seeders;

use App\Models\Image\Image;
use App\Models\Image\ImageRelation;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Haval',
                'link' => 'haval',
            ],
            [
                'name' => 'BYD',
                'link' => 'byd',
            ],
            [
                'name' => 'Geely',
                'link' => 'geely',
            ],
            [
                'name' => 'Changan',
                'link' => 'changan',
            ],
            [
                'name' => 'JAC',
                'link' => 'jac',
            ],
            [
                'name' => 'Chery',
                'link' => 'chery',
            ],
            [
                'name' => 'Lifan',
                'link' => 'lifan',
            ],
            [
                'name' => 'BAIC',
                'link' => 'baic',
            ],
            [
                'name' => 'Exeed',
                'link' => 'exeed',
            ],
            [
                'name' => 'FAW',
                'link' => 'faw',
            ],
            [
                'name' => 'Great Wall',
                'link' => 'great-wall',
            ],
            [
                'name' => 'Lotus',
                'link' => 'lotus',
            ],
            [
                'name' => 'Tank',
                'link' => 'tank',
            ],
            [
                'name' => 'Arcfox',
                'link' => 'arcfox',
            ],
            [
                'name' => 'Dongfeng',
                'link' => 'dongfeng',
            ],
            [
                'name' => 'Omoda',
                'link' => 'omoda',
            ],
            [
                'name' => 'Zeekr',
                'link' => 'zeekr',
            ]
        ];

        foreach ($brands as $brand) {
            $brandModel = Brand::factory()->create($brand);

            $isPng = $brand['link'] === 'baic' || $brand['link'] === 'faw' || $brand['link'] === 'arcfox' || $brand['link'] === 'lotus';

            $image = Image::query()->where('path', '/images/brand-'.$brand['link'].'.'.($isPng ? 'png' : 'svg'))->first();

            ImageRelation::factory()->create([
                'image_id'       => $image->getId(),
                'imageable_id'   => $brandModel->getId(),
                'imageable_type' => Brand::class,
            ]);
        }
    }
}
