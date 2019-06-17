<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $with = [
        'menus'
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
    public function navigation(): BelongsTo
    {
        return $this->belongsTo(Navigation::class);
    }

    /**
     * @return HasMany
     */
    public function menus(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * @return boolean
     */
    public function hasChildren()
    {
        return $this->menus && $this->menus->isNotEmpty();
    }

    /**
     * @param array $param
     *
     * @return mixed
     */
    public function getLink($param = [])
    {
        return $this->url;
    }
}
