<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Auth\AuthController@login')->name('login');

Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::middleware('auth:api')
    ->namespace('Auth')
    ->group(function () {
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });

Route::group(['auth:api' => ['except' => ['*.index']]],function () {
        Route::resource('posts', 'PostController');
        Route::resource('terms', 'TermController');
        Route::resource('categories', 'CategoryController');
        Route::resource('tags', 'TagController');

        Route::resource('comments', 'CommentController');
        Route::resource('posts.comments', 'CommentController');
    });


