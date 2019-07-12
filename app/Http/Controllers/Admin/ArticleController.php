<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Resources\Admin\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ArticleRequest $request
     *
     * @return ArticleResource
     */
    public function index(ArticleRequest $request)
    {
        $articles = Article::with('tags', 'user:id,name', 'category:id,name')
            ->when($keywords = $request->get('keywords'), function ($query) use ($keywords) {
                $query->where('title', 'like', `%{$keywords}%`);
            })
            ->when($tag = $request->get('tag'), function ($query) use ($tag) {
                $query->whereHas('tags', function ($query) use ($tag) {
                    $query->where('article_relate_id', $tag);
                });
            })
            ->when($user = $request->get('user'), function ($query) use ($user) {
                $query->where('user_id', $user);
            })
            ->when($category = $request->get('category'), function ($query) use ($category) {
                $query->where('category_id', $category);
            })
            ->when($request->get('status'), function ($query) use ($request) {
                $query->where('status', $request->get('status'));
            })
            ->orderByDesc('published_at', 'desc')
            ->paginate($request->get('per_page', 10));

        return new ArticleResource($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
