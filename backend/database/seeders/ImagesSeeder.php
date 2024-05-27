<?php

namespace Database\Seeders;

use App\Models\Image\Image;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $brandsImages = [
            [
                'path' => '/images/brand-geely.svg',
            ],
            [
                'path' => '/images/brand-haval.svg',
            ],
            [
                'path' => '/images/brand-byd.svg',
            ],
            [
                'path' => '/images/brand-chery.svg',
            ],
            [
                'path' => '/images/brand-great-wall.svg',
            ],
            [
                'path' => '/images/brand-changan.svg',
            ],
            [
                'path' => '/images/brand-tank.svg',
            ],
            [
                'path' => '/images/brand-omoda.svg',
            ],
            [
                'path' => '/images/brand-zeekr.svg',
            ],
            [
                'path' => '/images/brand-exeed.svg',
            ],
            [
                'path' => '/images/brand-jac.svg',
            ],
            [
                'path' => '/images/brand-lifan.svg',
            ],
            [
                'path' => '/images/brand-baic.png',
            ],
            [
                'path' => '/images/brand-faw.png',
            ],
            [
                'path' => '/images/brand-dongfeng.svg',
            ],
            [
                'path' => '/images/brand-arcfox.png',
            ],
            [
                'path' => '/images/brand-lotus.png',
            ],
        ];

        foreach ($brandsImages as $image) {
            Image::factory()->create($image);
        }
    }
}
