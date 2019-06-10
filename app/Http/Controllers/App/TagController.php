<?php

namespace App\Http\Controllers\App;

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
        $articles = Article::whereHas('tags', function ($query) use ($tag) {
            $query->where('id', $tag->id);
        })->paginate();

        if ($request->ajax()) {
            return view('components.card.article-list', compact('articles'));
        }

        $topArticles = Article::whereHas('tags', function ($query) use ($tag) {
            $query->where('id', $tag->id);
        })->orderByDesc('published_at')->take(4)->get();

        return view('tags.show', compact('articles', 'tag', 'topArticles'));
    }
}
