<?php

namespace App\Http\Controllers\App;

use App\Facades\Theme;
use App\Http\Controllers\Controller;
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
            $query->where('id', $tag->id);
        })->orderByDesc('published_at')->take(4)->get();

        $articles = Article::whereHas('tags', function ($query) use ($tag) {
            $query->where('id', $tag->id);
        })->whereNotIn('id', $topArticles->pluck('id'))
            ->paginate();

        Theme::title($tag->name);
        return view('tags.show', compact('articles', 'tag', 'topArticles'));
    }
}
