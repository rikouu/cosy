<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Admin', 'middleware' => ['auth:jwt'], 'name' => 'admin.'], function () {

    // Auth
    Route::get('profile', 'UserController@profile')->name('profile');

    // Api resource
//    Route::apiResource('user', 'UserController');
//    Route::apiResource('tag', 'TagController');
//    Route::apiResource('article', 'ArticleController');
//    Route::apiResource('comment', 'CommentController');
//    Route::apiResource('category', 'CategoryController');
//    Route::apiResource('setting', 'SettingController');
//    Route::apiResource('role', 'RoleController');

    // Dashboard
//    Route::get('statistics', 'PrismController@statistics');

    // File
//    Route::post('upload', 'MediaController@upload');
});

Route::group(['namespace' => 'Auth', 'middleware' => ['guest:jwt']], function () {
    Route::post('register', 'RegisterController@register')->name('register');
    Route::post('login', 'LoginController@login')->name('login');
});
