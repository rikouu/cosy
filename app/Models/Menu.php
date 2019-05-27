<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Menu
 *
 * @property string     name
 * @property string     description
 * @property Collection items
 */
class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];
    
    /**
     * @return HasMany
     */
    protected function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
