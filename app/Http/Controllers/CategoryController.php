<?php

namespace App\Http\Controllers;

use App\Facades\Blog;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::withCount('articles')->paginate();
        dd($categories);
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
        $category = Category::withCount('articles')->whereSlug($slug)->firstOrFail();
        $topCount = in_array($category->style, ['plain', 'medium']) ? 3 : 4;
        $topArticles = Article::whereCategoryId($category->id)
            ->whereTop(true)
            ->take($topCount)
            ->get();

        $articles = Article::with('category')
            ->whereCategoryId($category->id)
            ->when($topArticles->isNotEmpty(), function ($query) use ($topArticles) {
                $query->whereNotIn('id', $topArticles->pluck('id'));
            })
            ->paginate();

        Blog::title($category->name);
        return view('categories.show', compact('articles', 'category', 'topArticles'));
    }
}
