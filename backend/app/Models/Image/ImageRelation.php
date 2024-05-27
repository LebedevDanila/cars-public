<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageRelation extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'image_relations';

    public $timestamps = false;

    protected $fillable = [
        'image_id',
        'imageable_id',
        'imageable_type',
    ];

    public function getImageId(): ?string
    {
        return $this->attributes['image_id'] ?? null;
    }

    public function setImageId(string $imageId): self
    {
        $this->attributes['image_id'] = $imageId;
        return $this;
    }

    public function getImageableId(): ?int
    {
        return $this->attributes['imageable_id'] ?? null;
    }

    public function setImageableId(int $imageableId): self
    {
        $this->attributes['imageable_id'] = $imageableId;
        return $this;
    }

    public function getImageableType(): ?string
    {
        return $this->attributes['imageable_type'] ?? null;
    }

    public function setImageableType(string $imageableType): self
    {
        $this->attributes['imageable_type'] = $imageableType;
        return $this;
    }

}
