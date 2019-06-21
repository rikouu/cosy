<?php

namespace App\Models;

use App\Models\Traits\Menuable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;

/**
 * Class Menu
 *
 * @property Collection menus
 * @property string     url
 * @property string     route
 * @property array      parameters
 * @property Menuable   menuable
 * @property string     title
 */
class Menu extends Model
{
    use Menuable;

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
        'menus', 'menuable'
    ];

    /**
     * @return BelongsTo|null
     */
    public function parent(): ?BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return MorphTo|null
     */
    public function menuable(): ?MorphTo
    {
        return $this->morphTo();
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

    public function getName()
    {
        if (isset($this->menuable)) {
            return $this->menuable->getName();
        }
        return $this->title;
    }

    /**
     * @param array $param
     *
     * @return string
     */
    public function getLink($param = [])
    {
        try {
            if (!empty($this->menuable)) {
                return $this->menuable->getLink();
            }

            if (!empty($this->route)) {
                return route($this->route, json_decode($this->parameters, true));
            }
        } catch (\Exception $exception) {
        }
        return $this->url ?? 'javascript:;';
    }
}
