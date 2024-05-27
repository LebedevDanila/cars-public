<?php

namespace App\Models\News;

use App\Models\Image\Image;
use App\Models\Image\ImageRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $table = 'news_articles';

    protected $casts = [
        'tags' => 'array'
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getCategoryId(): ?int
    {
        return $this->attributes['category_id'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->attributes['name'] ?? null;
    }

    public function getLink(): ?string
    {
        return $this->attributes['link'] ?? null;
    }

    public function getText(): ?string
    {
        return $this->attributes['text'] ?? null;
    }

    public function getViews(): ?int
    {
        return $this->attributes['views'] ?? null;
    }

    public function getMetaTitle(): ?string
    {
        return $this->attributes['meta_title'] ?? null;
    }

    public function getMetaDescription(): ?string
    {
        return $this->attributes['meta_description'] ?? null;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->attributes['meta_keywords'] ?? null;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'] ?? null;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'] ?? null;
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id', 'id');
    }

    public function getCategory(): ?NewsCategory
    {
        return $this->category;
    }

    public function getTags(): ?array
    {
        return $this->tags ?? null;
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
