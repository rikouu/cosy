<?php

use App\Facades\Cosy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'App\HomeController@home');

Route::group(['prefix' => Cosy::path(),], function () {
    Route::get('/', 'Admin\DashboardController@dashboard')->name('dashboard');
    Route::get('/{any}', 'Admin\DashboardController@dashboard')->where('any', '.*');
});

