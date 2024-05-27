<?php

namespace App\Models;

use App\Models\Image\Image;
use App\Models\Image\ImageRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brands';

    protected $casts = [
        'status' => 'boolean'
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->attributes['name'] ?? null;
    }

    public function setName(string $name): self
    {
        $this->attributes['name'] = $name;
        return $this;
    }

    public function getLink(): ?string
    {
        return $this->attributes['link'] ?? null;
    }

    public function setLink(string $link): self
    {
        $this->attributes['link'] = $link;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->attributes['text'] ?? null;
    }

    public function setText(?string $text): self
    {
        $this->attributes['text'] = $text;
        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->attributes['status'] ?? null;
    }

    public function setStatus(bool $status): self
    {
        $this->attributes['status'] = $status;
        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->attributes['meta_title'] ?? null;
    }

    public function setMetaTitle(?string $metaTitle): self
    {
        $this->attributes['meta_title'] = $metaTitle;
        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->attributes['meta_description'] ?? null;
    }

    public function setMetaDescription(?string $metaDescription): self
    {
        $this->attributes['meta_description'] = $metaDescription;
        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->attributes['meta_keywords'] ?? null;
    }

    public function setMetaKeywords(?string $metaKeywords): self
    {
        $this->attributes['meta_keywords'] = $metaKeywords;
        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'] ?? null;
    }


    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'] ?? null;
    }

    public function imageRelation()
    {
        return $this->hasOne(
            ImageRelation::class,
            'imageable_id',
            'id'
        )
            ->where('imageable_type', self::class)
        ;
    }

    public function getImageRelation()
    {
        return $this->imageRelation;
    }

    public function image()
    {
        return $this->hasOneThrough(
            Image::class,
            ImageRelation::class,
            'imageable_id',
            'id',
            'id',
            'image_id'
        )->where('imageable_type', self::class);
    }

    public function getImage()
    {
        return $this->image;
    }

}
