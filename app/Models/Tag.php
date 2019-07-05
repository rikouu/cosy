<?php

namespace App\Models;

use App\Models\Traits\Menuable;
use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Tag.
 *
 * @property string name
 * @property string slug
 */
class Tag extends Model
{
    use Sluggable, Menuable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'image', 'description',
    ];

    /**
     * @return MorphToMany
     */
    public function articles(): MorphToMany
    {
        return $this->morphToMany(Article::class, 'article_relate');
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function getLink($params = [])
    {
        return route('tag.show', array_merge($params, ['id' => $this->slug]));
    }

    public function getName(): string
    {
        return $this->name;
    }
}
