<?php

namespace App\Models;

/**
 * Class Setting
 *
 * @package App\Models
 */
class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'display_name', 'value', 'details', 'type', 'group',
    ];

    /**
     * Determine if the given option value exists.
     *
     * @param string $key
     * @param string $group
     *
     * @return bool
     */
    public function exists(string $key, $group = '')
    {
        return self::where('key', $key)->where('group', $group)->exists();
    }
}
