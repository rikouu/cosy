<?php

namespace App\Http\Controllers;

use App\Facades\Blog;
use App\Http\Requests\SearchRequest;
use App\Models\Article;
use App\Models\SearchHistory;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function home(Request $request)
    {
        $articles = Article::with(['category'])->paginate(12);
        if ($request->query('isAjax')) {
            return view('components.articles.small', compact('articles'));
        }

        $slides = Slide::take(5)->get();
        $count = $slides->count();
        while ($count < 5) {
            $slide = new Slide();
            $slides->push($slide);
            $count++;
        }
        $slideBg = cdnPath('images/bg.jpg');

        return view('pages.home', compact('slides', 'articles', 'slideBg'));
    }

    public function history()
    {
    }

    /**
     * @return Response
     */
    public function feed()
    {
        $view = Cache::remember('feed', -1, function () {
            $articles = Article::all();

            return view('pages.feed', compact('articles'))->render();
        });

        return response($view)->header('Content-Type', 'text/xml');
    }

    /**
     * @param SearchRequest $request
     *
     * @return Response
     */
    public function search(SearchRequest $request)
    {
        $search = trim($request->q);

        $articles = Article::where('title', 'like', '%'.$search.'%')
            ->orWhereHas('tags', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->orWhereHas('topics', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->paginate();

        $cacheKey = $request->ip().$search;
        $hasSearch = Cache::get($cacheKey, false);
        if (!$hasSearch) {
            SearchHistory::firstOrCreate([
                'query'       => $search,
                'search_date' => Carbon::today()->toDateString(),
            ])
                ->increment('search_count');
            Cache::put($cacheKey, true, 600);
        }

        Blog::title(__('cosy.search.title', ['search' => $search]));

        return view('pages.search', compact('articles'));
    }

    /**
     * @return Response
     */
    public function siteMap()
    {
        $view = Cache::remember('sitemap', -1, function () {
            $articles = Article::all();

            return view('pages.sitemap', compact('articles'))->render();
        });

        return response($view)->header('Content-Type', 'text/xml');
    }
}
