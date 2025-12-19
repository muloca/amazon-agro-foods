<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'title_translations',
        'slug',
        'summary',
        'summary_translations',
        'content',
        'content_translations',
        'primary_image',
        'additional_images',
        'link',
        'published_at',
    ];

    protected $casts = [
        'additional_images' => 'array',
        'published_at' => 'datetime',
        'title_translations' => 'array',
        'summary_translations' => 'array',
        'content_translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function (News $news) {
            if (empty($news->slug)) {
                $news->slug = static::generateUniqueSlug($news->title);
            }
        });

        static::updating(function (News $news) {
            if ($news->isDirty('title') && empty($news->slug)) {
                $news->slug = static::generateUniqueSlug($news->title, $news->id);
            }
        });
    }

    public function getTitleAttribute($value): string
    {
        return $this->getTranslatedField($value, $this->title_translations);
    }

    public function getSummaryAttribute($value): ?string
    {
        return $this->getTranslatedField($value, $this->summary_translations);
    }

    public function getContentAttribute($value): string
    {
        return $this->getTranslatedField($value, $this->content_translations);
    }

    private function getTranslatedField($base, ?array $translations)
    {
        $translations = $translations ?? [];
        $locale = $this->normalizeLocale(app()->getLocale());

        if ($locale === 'pt_BR') {
            return $base;
        }

        return $translations[$locale] ?? $translations[$this->shortLocale($locale)] ?? $base;
    }

    private function normalizeLocale(?string $locale): string
    {
        return str_replace('-', '_', $locale ?? 'pt_BR');
    }

    private function shortLocale(string $locale): string
    {
        return explode('_', $locale)[0] ?: $locale;
    }

    protected static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug ?: Str::random(8);
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        return $this->primary_image ? url('storage/' . $this->primary_image) : url('images/no-image.svg');
    }

    public function getAdditionalImagesUrlsAttribute(): array
    {
        if (!is_array($this->additional_images) || empty($this->additional_images)) {
            return [];
        }

        return array_map(fn ($path) => url('storage/' . $path), $this->additional_images);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
