<?php

namespace App\Http\Controllers;

use App\Facades\Blog;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $tag = Tag::withCount('articles')->where('slug', $slug)->first();

        $topArticles = Article::whereHas('tags', function ($query) use ($tag) {
            $query->where('article_relate_id', $tag->id)->whereTop(true);
        })
            ->orderByDesc('published_at')->take(4)->get();

        $articles = Article::whereHas('tags', function ($query) use ($tag) {
            $query->where('article_relate_id', $tag->id);
        })
            ->when($topArticles->isNotEmpty(), function ($query) use ($topArticles) {
                $query->whereNotIn('id', $topArticles->pluck('id'));
            })
            ->paginate();

        Blog::title($tag->name);

        return view('tags.show', compact('articles', 'tag', 'topArticles'));
    }
}
