<?php

namespace App\Models;

use App\Models\Traits\Menuable;
use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category.
 *
 * @property string name
 * @property string slug
 */
class Category extends Model
{
    use Sluggable, Menuable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'image', 'description', 'parent_id',
    ];

    /**
     * @return HasMany
     */
    public function articles(): ?HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent(): ?BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @param null|array $params
     *
     * @return string
     */
    public function getLink($params = [])
    {
        return route('category.show', array_merge($params, ['slug' => $this->slug]));
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
