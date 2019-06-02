<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Article
 *
 * @package App\Models
 */
class Article extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'display_name', 'password', 'avatar', 'url',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'published_at',
    ];

    /**
     * @var array
     */
    protected $searchable = [

    ];

    /**
     * @return mixed
     */
    public function getPublishedDate()
    {
        $date = $this->published_at;
        if (Carbon::now() > $this->published_at->addDays(7)) {
            return $date->toDateString();
        }

        return $date->diffForHumans();
    }

    /**
     * @return BelongsTo
     */
    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany
     */
    protected function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    /**
     * @return HasMany
     */
    protected function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param null|array $params
     *
     * @return string
     */
    public function getLink($params = null)
    {
        return route('article.show', ['id' => $this->slug]);
    }

}
