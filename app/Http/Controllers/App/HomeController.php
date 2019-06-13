<?php

namespace App\Http\Controllers\App;

use App\Handlers\SlugTranslateHandler;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Slide;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function home()
    {
        $slides = Slide::take(5)->get();
        $count = $slides->count();
        while ($count < 5) {
            $slide = new Slide();
            $slide->title = '音乐推荐：融合东方韵味的梦幻摇滚《Sigh》The Bilinda Butchers';
            $slides->push($slide);
            $count++;
        }

        $articles = Article::with(['category'])->paginate();
        $slideBg = Storage::disk('qiniu')->getUrl('images/bg.jpg');
        return view('home', compact('slides', 'articles', 'slideBg'));
    }
}
