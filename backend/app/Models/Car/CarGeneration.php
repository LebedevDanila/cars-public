<?php

namespace App\Models\Car;

use App\Models\Image\Image;
use App\Models\Image\ImageRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarGeneration extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cars_generations';

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getModelId(): ?int
    {
        return $this->attributes['model_id'] ?? null;
    }

    public function setModelId(int $modelId): self
    {
        $this->attributes['model_id'] = $modelId;
        return $this;
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

    public function getType(): ?string
    {
        return $this->attributes['type'] ?? null;
    }

    public function setType(string $type): self
    {
        $this->attributes['type'] = $type;
        return $this;
    }

    public function getOtherNames(): ?string
    {
        return $this->attributes['other_names'] ?? null;
    }

    public function setOtherNames(?string $otherNames): self
    {
        $this->attributes['other_names'] = $otherNames;
        return $this;
    }

    public function getPriceTextRu(): ?string
    {
        return $this->attributes['price_text_ru'] ?? null;
    }

    public function setPriceTextRu(string $priceTextRu): self
    {
        $this->attributes['price_text_ru'] = $priceTextRu;
        return $this;
    }

    public function getPriceTextCn(): ?string
    {
        return $this->attributes['price_text_cn'] ?? null;
    }

    public function setPriceTextCn(string $priceTextCn): self
    {
        $this->attributes['price_text_cn'] = $priceTextCn;
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

    public function modifications()
    {
        return $this->hasMany(CarModification::class, 'generation_id', 'id');
    }

    public function getModifications()
    {
        return $this->modifications;
    }

    public function getModificationsMainSpecsEntities()
    {
        return $this->modifications
            ->flatMap(function ($modification) {
                return $modification->getSpecs();
            })
            ->mapToGroups(function ($spec) {
                return [
                    $spec->getCode() => [
                        'name'   => $spec->getName(),
                        'values' => [$spec->getModificationValue()],
                    ],
                ];
            })
            ->map(function ($spec) {
                return [
                    'name' => $spec[0]['name'],
                    'values' => $spec->pluck('values')->flatten()->all(),
                ];
            })
            ->values()
        ;
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'model_id', 'id');
    }

    public function getModel()
    {
        return $this->model;
    }

    public function imagesRelations()
    {
        return $this->hasMany(
            ImageRelation::class,
            'imageable_id',
            'id'
        )
            ->where('imageable_type', self::class)
        ;
    }

    public function getImagesRelations()
    {
        return $this->imagesRelations;
    }

    public function images()
    {
        return $this->morphToMany(
            Image::class,
            'imageable',
            'image_relations',
            'imageable_id',
            'image_id'
        );
    }

    public function getImages()
    {
        return $this->images;
    }

}
