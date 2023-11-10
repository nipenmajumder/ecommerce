<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'key', 'value'];

    /**
     * Get all the settings
     *
     * @return self
     */
    public static function getAllSettings()
    {
        return Cache::rememberForever('settings.all', static function () {
            return self::select(['key', 'value'])->get();
        });
    }

    /**
     * Get all the settings in array
     */
    public static function getSettingsArray(): array
    {
        return Cache::rememberForever('settings.toArray', static function () {
            return self::getAllSettings()->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Check if setting exists
     */
    public static function has(string $key): bool
    {
        return (bool) self::getAllSettings()->whereStrict('key', $key)->count();
    }

    /**
     * Get a settings value
     */
    public static function get(string $key, string $default = null): ?string
    {
        if (self::has($key)) {
            $setting = self::getAllSettings()->where('key', $key)->first();

            return $setting->value;
        }

        return $default;
    }

    /**
     * Add a settings value
     */
    public static function add(string $key, string $value): bool|string
    {
        if (self::has($key)) {
            return self::set($key, $value);
        }

        return self::create(['key' => $key, 'value' => $value]) ?? $value;
    }

    /**
     * Set a value for setting
     */
    public static function set($key, $value): bool|string
    {
        if ($setting = self::where('key', $key)->first()) {
            return $setting->update([
                'key' => $key,
                'value' => $value,
            ]);
        }

        return self::add($key, $value);
    }

    /**
     * Update Settings
     */
    public static function updateSettings(array $data): void
    {
        foreach ($data as $key => $value) {
            self::set($key, $value);
        }
    }

    /**
     * Flush the cache
     */
    public static function flushCache(): void
    {
        Cache::forget('settings.all');
        Cache::forget('settings.toArray');
    }

    /**
     * The "booting" method of the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function () {
            self::flushCache();
        });

        static::deleted(function () {
            self::flushCache();
        });
    }
}
