<?php

namespace App\Models;

use App\Models\ArticleContent as Content;
use App\Models\Scopes\PublishOrderScope;
use App\Models\Traits\Likable;
use App\Models\Traits\Menuable;
use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * Class Article
 *
 * @property string  slug
 * @property Content content
 * @property Carbon  published_at
 * @property string  template
 * @property string  type
 * @property string  title
 */
class Article extends Model
{
    use Sluggable, Menuable, Likable;

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
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PublishOrderScope());
    }

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
     * Next Article.
     *
     * @return Article
     */
    public function nextArticle()
    {
        return self::withoutGlobalScope(PublishOrderScope::class)
            ->where('published_at', '>', $this->published_at)
            ->where('status', 'published')
            ->orderBy('published_at', 'asc')->first();
    }

    /**
     * Previous Article.
     *
     * @return Article
     */
    public function prevArticle()
    {
        return self::where('published_at', '<', $this->published_at)
            ->where('status', 'published')
            ->first();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->morphedByMany(Tag::class, 'article_relate');
    }

    /**
     * @return BelongsToMany
     */
    public function topics(): BelongsToMany
    {
        return $this->morphedByMany(Topic::class, 'article_relate');
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function getLink($params = [])
    {
        return route('article.show', array_merge($params, ['id' => $this->slug]));
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->title;
    }

    /**
     * @return HasOne
     */
    public function content(): HasOne
    {
        return $this->hasOne(Content::class);
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        $template = $this->template;
        if (empty($template)) {
            $template = 'template.'.$this->type;
        }

        return $template;
    }

}
