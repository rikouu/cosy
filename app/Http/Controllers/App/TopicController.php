<?php

namespace App\Http\Controllers\App;

use App\Facades\Blog;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TopicController extends Controller
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
        $topic = Topic::withCount('articles')->where('slug', $slug)->first();

        $topArticles = Article::whereHas('topics', function ($query) use ($topic) {
            $query->where('id', $topic->id);
        })->orderByDesc('published_at')->take(4)->get();

        $articles = Article::whereHas('topics', function ($query) use ($topic) {
            $query->where('id', $topic->id);
        })->whereNotIn('id', $topArticles->pluck('id'))
            ->paginate();

        Blog::title($topic->name);
        return view('topics.show', compact('articles', 'topic', 'topArticles'));
    }
}
