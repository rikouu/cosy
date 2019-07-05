<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class CategoryBuilder
 *
 * @package App\Models\Builders
 */
class CategoryBuilder extends Builder
{

    /**
     * @param string $slug
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function slug(string $slug)
    {
        return $this->query->where('slug', $slug);
    }

}
