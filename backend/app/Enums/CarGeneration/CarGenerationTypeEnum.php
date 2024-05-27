<?php

declare(strict_types=1);

namespace App\Enums\CarGeneration;

enum CarGenerationTypeEnum: string
{
    case SEDAN = 'sedan';
    case WAGON = 'wagon';
    case COUPE = 'coupe';
    case CABRIOLET = 'cabriolet';
    case LIFTBACK = 'liftback';
    case HATCHBACK_3_DOORS = 'hatchback_3_doors';
    case HATCHBACK_5_DOORS = 'hatchback_5_doors';
    case ALLROAD_5_DOORS = 'allroad_5_doors';

    public function name(): string
    {
        return match ($this) {
            self::SEDAN => 'Седан',
            self::WAGON => 'Универсал',
            self::COUPE => 'Купе',
            self::CABRIOLET => 'Кабриолет',
            self::LIFTBACK => 'Лифтбэк',
            self::HATCHBACK_3_DOORS => 'Хэтчбек 3 дв.',
            self::HATCHBACK_5_DOORS => 'Хэтчбек 5 дв',
            self::ALLROAD_5_DOORS => 'Внедорожник 5 дв',
        };
    }

    public static function keys(): array
    {
        $result = [];

        foreach (self::cases() as $case) {
            $result[] = $case->name;
        }

        return $result;
    }

    public static function values(): array
    {
        $result = [];

        foreach (self::cases() as $case) {
            $result[] = $case->value;
        }

        return $result;
    }

    public static function localized(): array
    {
        $result = [];

        foreach (self::cases() as $case) {
            $result[$case->value] = $case->name();
        }

        return $result;
    }
}
