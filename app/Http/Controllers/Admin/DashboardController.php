<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function statistics()
    {
        return [];
    }
}
