<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Slide;
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
//        $list = glob(public_path('/blog/**/**.md'));
//        $articles = Article::with('content')->take(count($list))->get();
//        foreach ($list as $key => $item) {
//            $title = substr($item, strrpos($item, "/") + 1);;
//            $title = substr($title, 0, strrpos($title, "."));
//            $article = $articles[$key];
//            $article->title = $title;
//            $article->content->markdown = file_get_contents($item);
//            $article->save();
//            $article->content->save();
//        }
        $slides = Cache::remember('slides', '120', function () {
            $slides = Slide::take(5)->get();
            $count = $slides->count();
            while ($count < 5) {
                $slide = new Slide();
                $slide->title = '音乐推荐：融合东方韵味的梦幻摇滚《Sigh》The Bilinda Butchers';
                $slides->push($slide);
                $count++;
            }
            return $slides;
        });
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
}
