<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'primary_image',
        'additional_images',
        'link',
        'published_at',
    ];

    protected $casts = [
        'additional_images' => 'array',
        'published_at' => 'datetime',
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
