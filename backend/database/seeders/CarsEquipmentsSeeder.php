<?php

namespace Database\Seeders;

use App\Models\Car\CarEquipment;
use App\Models\Car\CarEquipmentEntity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CarsEquipmentsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $equipments = [
            [
                'name' => 'Комфорт',
                'entities' => [
                    ['name' => 'Камера 360'],
                    ['name' => 'Усилитель руля'],
                    ['name' => 'Парктроник задний'],
                    ['name' => 'Бортовой компьютер'],
                    ['name' => 'Парктроник передний'],
                    ['name' => 'Проекционный дисплей'],
                    ['name' => 'Климат-контроль многозонный'],
                    ['name' => 'Электростеклоподъемники передние'],
                ]
            ],
            [
                'name' => 'Обзор',
                'entities' => [
                    ['name' => 'Датчик света'],
                    ['name' => 'Светодиодные фары'],
                    ['name' => 'Дневные ходовые огни'],
                    ['name' => 'Электрообогрев боковых зеркал'],
                    ['name' => 'Система управления дальним светом'],
                ]
            ],
            [
                'name' => 'Салон',
                'entities' => [
                    ['name' => 'Люк'],
                    ['name' => 'Тонированные стекла'],
                    ['name' => 'Кожа (Материал салона)'],
                    ['name' => 'Память сиденья водителя'],
                    ['name' => 'Декоративные накладки на педали'],
                    ['name' => 'Электрорегулировка передних сидений'],
                ]
            ],
            [
                'name' => 'Мультимедиа',
                'entities' => [
                    ['name' => 'USB'],
                    ['name' => 'CarPlay'],
                    ['name' => 'Bluetooth'],
                    ['name' => 'Розетка 12V'],
                    ['name' => 'Аудиосистема'],
                    ['name' => 'Голосовое управление'],
                    ['name' => 'Мультимедиа система с ЖК-экраном'],
                ]
            ],
            [
                'name' => 'Элементы экстерьера',
                'entities' => [
                    ['name' => 'Диски 19'],
                ]
            ],
            [
                'name' => 'Защита от угона',
                'entities' => [
                    ['name' => 'Иммобилайзер'],
                    ['name' => 'Сигнализация'],
                    ['name' => 'Центральный замок'],
                ]
            ],
            [
                'name' => 'Безопасность',
                'entities' => [
                    ['name' => 'Датчик давления в шинах'],
                    ['name' => 'Датчик усталости водителя'],
                    ['name' => 'Система стабилизации (ESP)'],
                    ['name' => 'Система контроля слепых зон'],
                    ['name' => 'Подушки безопасности боковые'],
                    ['name' => 'Подушка безопасности водителя'],
                ]
            ],
            [
                'name' => 'Прочее',
                'entities' => [
                    ['name' => 'Докатка'],
                    ['name' => 'Активная подвеска'],
                ]
            ],
        ];

        foreach ($equipments as $key => $equipment) {
            $equipmentId = $key + 1;

            CarEquipment::factory()
                ->create([
                    'code' => Str::slug($equipment['name']),
                    'name' => $equipment['name']
                ])
            ;

            foreach ($equipment['entities'] as $entity) {
                CarEquipmentEntity::factory()
                    ->create([
                        'equipment_id' => $equipmentId,
                        'code'         => Str::slug($entity['name']),
                        'name'         => $entity['name']
                    ]);
            }
        }
    }
}
