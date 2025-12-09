<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'name_translations',
        'description_translations',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'name_translations' => 'array',
        'description_translations' => 'array',
    ];

    /**
     * Relacionamento com produtos
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Return translated name when available for current locale.
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
     * Return translated description when available for current locale.
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
