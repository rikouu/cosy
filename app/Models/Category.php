<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 *
 * @package App\Models
 */
class Category extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'image', 'description',
    ];

    /**
     * @return HasMany
     */
    protected function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * @param null|array $params
     *
     * @return string
     */
    public function getLink($params = null)
    {
        return route('category.show', ['id' => $this->slug]);
    }
}
