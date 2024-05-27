<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Uid\Ulid;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    public $incrementing = false;

    public $timestamps = false;

    protected $hidden = [
        'laravel_through_key'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (!(   isset($this->attributes['id'])
            && is_string($this->attributes['id'])
            && Ulid::isValid($this->attributes['id'])
        )
        ) {
            $this->attributes['id'] = Ulid::generate();
        }
    }

    public function getId(): ?string
    {
        return $this->attributes['id'] ?? null;
    }

    public function setId(string $id): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function getPath(): ?string
    {
        return $this->attributes['path'] ? env('AWS_URL') . $this->attributes['path'] : null;
    }

    public function setPath(string $path): self
    {
        $this->attributes['path'] = $path;
        return $this;
    }

    public function getHash(): ?string
    {
        return $this->attributes['hash'] ?? null;
    }

    public function setHash(string $hash): self
    {
        $this->attributes['hash'] = $hash;
        return $this;
    }

}
