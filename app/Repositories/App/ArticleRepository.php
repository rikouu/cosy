<?php

namespace App\Repositories\App;

use App\Models\Article;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Storage;

class ArticleRepository extends Repository
{

    public function paginate()
    {
        $articles = Article::orderByDesc('published_at')->paginate();

        $articles->load([
//            'category',
//            'user',
        ]);

        return $articles;
    }

}
