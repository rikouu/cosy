<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function search(Request $request)
    {
        view('pages.search');
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
