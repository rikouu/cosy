<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ArticleBuilder
 *
 * @package App\Models\Builders
 */
class ArticleBuilder extends Builder
{

    /**
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return ArticleBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new ArticleBuilder($query);
    }

}
