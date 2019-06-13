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

// 作者页
Route::match(['get', 'post'], 'author/{slug}', 'App\UserController@show')->name('user.show');

// 分类页
Route::match(['get', 'post'], 'category/{slug}', 'App\CategoryController@show')->name('category.show');
Route::match(['get', 'post'], 'category', 'App\CategoryController@index')->name('category.index');

// 标签页
Route::match(['get', 'post'], 'tag/{slug}', 'App\TagController@show')->name('tag.show');
Route::match(['get', 'post'], 'tag', 'App\TagController@index')->name('tag.index');

// 专题页
Route::match(['get', 'post'], 'topic/{slug}', 'App\TopicController@show')->name('topic.show');
Route::match(['get', 'post'], 'topic', 'App\TopicController@index')->name('topic.index');

// 文章页
Route::get('{slug}.html', 'App\ArticleController@show')->name('article.show');
Route::get('random-article', 'App\ArticleController@randomArticle')->name('article.random');

Route::group(['prefix' => Cosy::path(),], function () {
    Route::get('/', 'Admin\DashboardController@dashboard')->name('dashboard');
    Route::get('/{any}', 'Admin\DashboardController@dashboard')->where('any', '.*');
});
