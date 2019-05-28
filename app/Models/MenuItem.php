<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
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
    protected function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
