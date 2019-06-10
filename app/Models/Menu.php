<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * Class Menu
 */
class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'url', 'target', 'image',
        'icon', 'order', 'parent_id', 'route', 'parameters',
        'status', 'menu_id',
    ];

    /**
     * @return BelongsTo|null
     */
    protected function parent(): ?BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return BelongsTo
     */
    protected function navigation(): BelongsTo
    {
        return $this->belongsTo(Navigation::class);
    }
}
