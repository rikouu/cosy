<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Topic
 *
 * @property string slug
 */
class Topic extends Model
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
     * @return BelongsToMany
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_topic');
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function getLink($params = [])
    {
        return route('topic.show', array_merge($params, ['id' => $this->slug]));
    }
}
