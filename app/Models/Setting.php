<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Get setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        return json_decode($setting->value, true);
    }

    /**
     * Check if menu is enabled
     */
    public static function isMenuEnabled($menuKey)
    {
        return static::get($menuKey, true);
    }
}
