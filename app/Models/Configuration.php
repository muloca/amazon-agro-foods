<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Configuration extends Model
{
    protected $fillable = [
        'key',
        'group',
        'label',
        'value',
        'value_pt',
        'value_en',
        'value_ar',
        'type',
        'options',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get configuration value by key
     */
    public static function getValue($key, $default = null)
    {
        $locale = app()->getLocale();

        $config = static::where('key', $key)
            ->where('is_active', true)
            ->first();

        if (! $config) {
            return $default;
        }

        $localizedValue = $config->getLocalizedValue($locale);

        return $localizedValue ?? $default;
    }

    /**
     * Set configuration value
     */
    public static function setValue($key, $value)
    {
        $config = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        
        Cache::forget("config.{$key}");
        return $config;
    }

    public function getLocalizedValue(?string $locale = null)
    {
        $locale ??= app()->getLocale();
        $normalized = str_replace('-', '_', strtolower($locale));

        $map = [
            'pt_br' => 'value_pt',
            'pt' => 'value_pt',
            'en' => 'value_en',
            'en_us' => 'value_en',
            'ar' => 'value_ar',
            'ar_sa' => 'value_ar',
        ];

        $column = $map[$normalized] ?? null;

        if (! $column && str_contains($normalized, '_')) {
            $short = explode('_', $normalized)[0];
            $column = $map[$short] ?? null;
        }

        if ($column && filled($this->{$column})) {
            return $this->{$column};
        }

        if (filled($this->value)) {
            return $this->value;
        }

        return null;
    }

    /**
     * Get all configurations by group
     */
    public static function getByGroup($group)
    {
        return static::where('group', $group)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Clear all configuration cache
     */
    public static function clearCache()
    {
        Cache::flush();
    }
}
