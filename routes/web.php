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

// 首页
Route::get('/', 'App\HomeController@home');

// 历史页
Route::get('history', 'App\HomeController@history')->name('history');

// 搜索页
Route::get('search/{q?}', 'App\HomeController@search')->name('search');

// 作者页
Route::get('author/{slug}', 'App\UserController@show')->name('user.show');

// 分类页
Route::get('category/{slug}', 'App\CategoryController@show')->name('category.show');
Route::get('category', 'App\CategoryController@index')->name('category.index');

// 标签页
Route::get('tag/{slug}', 'App\TagController@show')->name('tag.show');
Route::get('tag', 'App\TagController@index')->name('tag.index');

// 专题页
Route::get('topic/{slug}', 'App\TopicController@show')->name('topic.show');
Route::get('topic', 'App\TopicController@index')->name('topic.index');

// 文章页
Route::get('{slug}.html', 'App\ArticleController@show')->name('article.show');
Route::get('random-article', 'App\ArticleController@randomArticle')->name('article.random');

// Site Map
Route::get('sitemap', 'App\HomeController@siteMap')->name('sitemap');

// 幻灯片
Route::get('slide/{id}', 'App\SlideController@show')->name('slide.show');

// RSS Feed
Route::get('feed.xml', 'App\HomeController@feed')->name('feed');

Route::group(['prefix' => Cosy::path(),], function () {
    Route::get('/', 'Admin\DashboardController@dashboard')->name('dashboard');
    Route::get('/{any}', 'Admin\DashboardController@dashboard')->where('any', '.*');
});

Route::group(['middleware' => 'throttle:5,1'], function () {
    Route::post('article/{id}/like', 'App\ArticleController@like')->name('article.like');
});
