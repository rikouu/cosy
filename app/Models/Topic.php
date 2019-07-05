<?php

namespace App\Models;

use App\Models\Traits\Menuable;
use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Topic.
 *
 * @property string slug
 * @property string name
 */
class Topic extends Model
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
        return route('topic.show', array_merge($params, ['slug' => $this->slug]));
    }

    public function getName(): string
    {
        return $this->name;
    }
}
