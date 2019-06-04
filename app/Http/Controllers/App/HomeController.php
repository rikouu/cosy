<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Repositories\App\ArticleRepository;
use App\Repositories\App\SlideRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * @var SlideRepository
     */
    protected $slides;

    /**
     * @var ArticleRepository
     */
    protected $articles;

    /**
     * HomeController constructor.
     *
     * @param SlideRepository   $slides
     * @param ArticleRepository $articles
     */
    public function __construct(SlideRepository $slides, ArticleRepository $articles)
    {
        $this->articles = $articles;
        $this->slides = $slides;
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function home()
    {
        $slides = $this->slides->top();
        $articles = $this->articles->paginate();
        $slideBg = Storage::disk('qiniu')->getUrl('images/bg.jpg');
        return view('home', compact('slides', 'articles', 'slideBg'));
    }
}
