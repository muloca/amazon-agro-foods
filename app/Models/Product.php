<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'line',
        'image',
        'additional_images',
        'category_id',
        'is_active',
        'name_translations',
        'description_translations',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'additional_images' => 'array',
        'name_translations' => 'array',
        'description_translations' => 'array',
    ];

    /**
     * Acessor para obter a URL completa da imagem principal
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }
        
        return url('images/no-image.svg');
    }

    /**
     * Acessor para obter as URLs das imagens adicionais
     */
    public function getAdditionalImagesUrlsAttribute(): array
    {
        if (!$this->additional_images) {
            return [];
        }

        return array_map(function ($image) {
            return url('storage/' . $image);
        }, $this->additional_images);
    }

    /**
     * Acessor para obter todas as imagens (principal + adicionais)
     */
    public function getAllImagesUrlsAttribute(): array
    {
        $images = [];
        
        if ($this->image) {
            $images[] = $this->image_url;
        }
        
        $images = array_merge($images, $this->additional_images_urls);
        
        return $images;
    }

    /**
     * Relacionamento com categoria
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Return translated name based on current locale.
     */
    public function getNameAttribute($value): string
    {
        $translations = $this->name_translations ?? [];
        $locale = $this->normalizeLocale(app()->getLocale());

        if ($locale === 'pt_BR') {
            return $value;
        }

        return $translations[$locale] ?? $translations[$this->shortLocale($locale)] ?? $value;
    }

    /**
     * Return translated description based on current locale.
     */
    public function getDescriptionAttribute($value): ?string
    {
        $translations = $this->description_translations ?? [];
        $locale = $this->normalizeLocale(app()->getLocale());

        if ($locale === 'pt_BR') {
            return $value;
        }

        return $translations[$locale] ?? $translations[$this->shortLocale($locale)] ?? $value;
    }

    private function normalizeLocale(?string $locale): string
    {
        return str_replace('-', '_', $locale ?? 'pt_BR');
    }

    private function shortLocale(string $locale): string
    {
        return explode('_', $locale)[0] ?: $locale;
    }
}
