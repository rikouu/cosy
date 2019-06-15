<?php

namespace App\Http\Controllers\App;

use App\Facades\Theme;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param string $slug
     *
     * @return Response
     */
    public function show($slug)
    {
        try {
            $article = Article::with('content', 'category', 'tags', 'user')->where('slug', $slug)->firstOrFail();
            $isLiked = true;
            $content = $article->content;
            if (empty($content)) {
                abort(404);
            }

            Theme::title($article->title);
            return view('articles.' . $article->getTemplate(), compact('article', 'content', 'isLiked'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * @return Response
     */
    public function randomArticle()
    {
        $article = Article::inRandomOrder()->first();
        return redirect($article->getLink());
    }
}
