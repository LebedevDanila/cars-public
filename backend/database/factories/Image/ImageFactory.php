<?php

namespace Database\Factories\Image;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Symfony\Component\Uid\Ulid;

class ImageFactory extends Factory
{

    public function definition()
    {
        return [
            'id'   => Ulid::generate(),
            'path' => fake()->imageUrl(),
            'hash' => fake()->md5(),
        ];
    }

}
