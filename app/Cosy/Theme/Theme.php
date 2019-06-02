<?php

namespace App\Cosy\Theme;

use App\Models\SearchHistory;

class Theme
{
    public function navigation($name = '')
    {
        return collect([]);
    }

    public function searchTop($limit = 8)
    {
        $limit = max($limit, 3);
        $searches = SearchHistory::groupBy('query')->selectRaw('query, sum(search_count) as search_count')->orderByDesc('search_count')->take($limit)->get();
        return $searches;
    }

}
