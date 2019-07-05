<?php

namespace App\Http\Controllers;

use App\Facades\Blog;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\GenerateArticleSeo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * @param Request $request
     * @param         $slug
     *
     * @return Response
     */
    public function show(Request $request, $slug)
    {
        try {
            $article = Article::with('content', 'category', 'tags', 'user')
                ->with(['comments' => function ($query) {
                    $query->with('comments')->where('parent_id', '=', 0);
                }])
                ->where('slug', $slug)->firstOrFail();
            $likes = Cache::get($request->ip().'(liked list)', []);
            $isLiked = in_array($article->id, $likes);
            $content = $article->content;
            if (empty($content)) {
                abort(404);
            }

            Blog::title($article->title);
            if (empty($content->keywords)) {
                GenerateArticleSeo::dispatch($content)->delay(now()->addSeconds(10));
            }

            $readKey = $request->ip().' read '.$article->id;
            $hasRead = Cache::get($readKey, false);
            if (! $hasRead) {
                $article->increment('views_count');
                Cache::put($readKey, true, 60 * 60);
            }

            return view('articles.'.$article->getTemplate(), compact('article', 'content', 'isLiked'));
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

    public function showLike($id)
    {
    }

    public function like(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->like();

        return response([
            'likesCount' => number_format($article->likes_count),
            'isLike'     => $article->isLiked(),
        ]);
    }
}
