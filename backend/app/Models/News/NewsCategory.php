<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $table = 'news_categories';

    public $timestamps = false;

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->attributes['name'] ?? null;
    }

    public function getLink(): ?string
    {
        return $this->attributes['link'] ?? null;
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

}
