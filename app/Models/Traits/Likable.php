<?php

namespace App\Models\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;

/**
 * Trait Likable.
 */
trait Likable
{
    /**
     * @var null|Collection
     */
    private static $_liked;

    /**
     * @return string
     */
    public function getLikeKey()
    {
        return md5('prism_like_'.self::class);
    }

    /**
     * @return int
     */
    public function isLiked()
    {
        if (is_null(self::$_liked)) {
            self::$_liked = collect(explode(',', Cookie::get($this->getLikeKey())))->filter(function ($item) {
                return !empty($item);
            })->map(function ($item) {
                return (int) $item;
            });
        }

        return self::$_liked->contains($this->id);
    }

    public function like()
    {
        if ($this->isLiked()) {
            self::$_liked = self::$_liked->filter(function ($value) {
                return $this->id !== $value;
            });
            $this->decrement('likes_count');
        } else {
            self::$_liked->push($this->id);
            $this->increment('likes_count');
        }
        Cookie::queue($this->getLikeKey(), self::$_liked->implode(','), 99999);

        return $this->likes_count;
    }
}
