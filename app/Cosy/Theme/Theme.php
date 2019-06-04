<?php

namespace App\Cosy\Theme;

use App\Models\Article;
use App\Models\Category;
use App\Models\Link;
use App\Models\SearchHistory;
use App\Models\Tag;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function socials()
    {
        $socials = collect([
            'github'      => 'https://github.com/loyep',
            'weibo'       => 'https://github.com/loyep',
            'qq'          => 'https://github.com/loyep',
            'weixin'          => 'https://github.com/loyep',
            'google-plus-g' => 'https://github.com/loyep',
            'twitter'     => 'https://github.com/loyep',
            'facebook-f'    => 'https://github.com/loyep',
        ]);

        return $socials->map(function ($item) {
            if (is_array($item) && !empty($item['link'])) {
                $item['img'] = 'data:image/png;base64,' . base64_encode(QrCode::format('png')->size(320)->generate($item['link']));
            }

            return $item;
        });
    }

    public function info()
    {
        return ['year' => null];
    }

    /**
     * @return mixed
     */
    public function links()
    {
        $links = Link::take(6)->get();

        return $links;
    }

    /**
     * @return mixed
     */
    public function footerTags()
    {
        return Tag::take(16)->get();
    }

    public function convergence($article)
    {
        $articles = Article::where('category_id', $article->category_id)->take(4)->get();

        return $articles;
    }

    /**
     * @return mixed
     */
    public function footerCategories()
    {
        return Category::take(12)->get();
    }

}
