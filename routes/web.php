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

Route::get('history', 'App\HomeController@history')->name('history');
Route::get('search', 'App\HomeController@history')->name('search');

Route::get('{slug}.html', 'App\ArticleController@show')->name('article.show');

// 文章页
Route::get('{slug}.html', 'App\ArticleController@show')->name('article.show');

// 分类页
Route::match(['get', 'post'], 'category/{slug}', 'CategoryController@show')->name('category.show');

// 标签页
Route::match(['get', 'post'], 'tag/{slug}', 'TagController@show')->name('tag.show');

Route::group(['prefix' => Cosy::path(),], function () {
    Route::get('/', 'Admin\DashboardController@dashboard')->name('dashboard');
    Route::get('/{any}', 'Admin\DashboardController@dashboard')->where('any', '.*');
});

