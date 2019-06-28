<?php

namespace App\Http\Controllers\App;

use App\Facades\Blog;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Article;
use App\Models\SearchHistory;
use App\Models\Slide;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function home()
    {
//        $slides = Cache::remember('slides', '120', function () {
        $slides = Slide::take(5)->get();
        $count = $slides->count();
        while ($count < 5) {
            $slide = new Slide();
            $slides->push($slide);
            $count++;
        }
//            return $slides;
//        });
        $articles = Article::with(['category'])->paginate();
        $slideBg = cdnPath('images/bg.jpg');
        return view('home', compact('slides', 'articles', 'slideBg'));
    }

    /**
     *
     */
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
        $query = trim($request->q);

        $articles = Article::search($query)->paginate();

        dd($articles);
        $cacheKey = $request->ip().$query;
        $hasSearch = Cache::get($cacheKey, false);
        if (!$hasSearch) {
            SearchHistory::firstOrCreate([
                'query'       => $query,
                'search_date' => Carbon::today()->toDateString()
            ])
                ->increment('search_count');
            Cache::put($cacheKey, true, 600);
        }

        Blog::title(__('cosy.search.title', ['search' => $query]));
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
