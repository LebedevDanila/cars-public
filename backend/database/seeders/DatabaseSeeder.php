<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ImagesSeeder::class,
            BrandsSeeder::class,
            NewsSeeder::class,
            CarsSpecsSeeder::class,
            CarsEquipmentsSeeder::class,
            CarsContentSeeder::class,
        ]);
    }
}
