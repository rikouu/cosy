<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param string  $slug
     * @param Request $request
     *
     * @return Response
     */
    public function show(string $name, Request $request)
    {
        //
        $user = User::withCount('articles')->whereName($name)->firstOrFail();

        $articles = Article::with('category')
            ->whereUserId($user->id)
            ->paginate();

//        if ($request->ajax()) {
//            return view('components.card.article-list', compact('articles'));
//        }

        return view('users.show', compact('articles', 'user'));
    }
}
