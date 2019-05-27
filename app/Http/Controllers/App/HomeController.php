<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function home()
    {
        return view('home');
    }
}
