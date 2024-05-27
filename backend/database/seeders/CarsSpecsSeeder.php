<?php

namespace Database\Seeders;

use App\Models\Car\CarSpec;
use App\Models\Car\CarSpecEntity;
use Illuminate\Database\Seeder;

class CarsSpecsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $specs = [
            [
                'code' => 'COMMON', // auto.ru GENERAL
                'name' => 'Общая информация',
                'entities' => [
                    [
                        'code' => 'country',
                        'name' => 'Страна марки',
                    ],
                    [
                        'code' => 'auto_class',
                        'name' => 'Класс автомобиля',
                    ],
                    [
                        'code' => 'doors_count',
                        'name' => 'Количество дверей',
                    ],
                ],
            ],
            [
                'code' => 'SIZES',
                'name' => 'Размеры',
                'entities' => [
                    [
                        'code' => 'width',
                        'name' => '1024X680',
                    ],
                ],
            ],
            [
                'code' => 'VOLUME_AND_MASS',
                'name' => 'Объём и масса',
                'entities' => [
                    [
                        'code' => 'tank_volume',
                        'name' => 'Объём топливного бака',
                    ],
                ],
            ],
            [
                'code' => 'TRANSMISSION',
                'name' => 'Трансмиссия',
                'entities' => [
                    [
                        'code' => 'gear_value',
                        'name' => 'Количество передач',
                    ],
                ],
            ],
            [
                'code' => 'SUSPENSION_AND_BRAKES',
                'name' => 'Подвеска и тормоза',
                'entities' => [
                    [
                        'code' => 'front_suspension',
                        'name' => 'Тип передней подвески',
                    ],
                    [
                        'code' => 'back_suspension',
                        'name' => 'Тип задней подвески',
                    ],
                ],
            ],
            [
                'code' => 'PERFORMANCE_INDICATORS',
                'name' => 'Эксплуатационные показатели',
                'entities' => [
                    [
                        'code' => 'max_speed',
                        'name' => 'Максимальная скорость',
                    ],
                    [
                        'code' => 'acceleration',
                        'name' => 'Разгон до 100 км/ч',
                    ],
                ],
            ],
            [
                'code' => 'ENGINE',
                'name' => 'Двигатель',
                'entities' => [
                    [
                        'code' => 'engine_type',
                        'name' => 'Тип двигателя',
                    ],
                    [
                        'code' => 'valves',
                        'name' => 'Число клапанов на цилиндр',
                    ],
                    [
                        'code' => 'compression',
                        'name' => 'Степень сжатия',
                    ],
                ],
            ],
        ];

        foreach ($specs as $key => $spec) {
            $specId = $key + 1;

            CarSpec::factory()
                ->create([
                    'code' => $spec['code'],
                    'name' => $spec['name']
                ])
            ;

            foreach ($spec['entities'] as $entity) {
                CarSpecEntity::factory()
                    ->create([
                        'spec_id' => $specId,
                        'code'    => $entity['code'],
                        'name'    => $entity['name']
                    ]);
            }
        }
    }
}
