<?php

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

Route::group(['middleware' => 'auth'] , function(){

    Route::resource('channels', 'ChannelsController');

    Route::get('/discussion/create', [
        'uses' => 'DiscussionsController@create',
        'as' => 'discussion.create'
    ]);

    Route::get('/discussion/edit/{id}', [
        'uses' => 'DiscussionsController@edit',
        'as' => 'discussion.edit'
    ]);

    Route::post('/discussion/store', [
        'uses' => 'DiscussionsController@store',
        'as' => 'discussion.store'
    ]);

    Route::post('/discussion/update/{id}', [
        'uses' => 'DiscussionsController@update',
        'as' => 'discussion.update'
    ]);

    Route::post('/discussion/reply/{id}', [
        'uses' => 'DiscussionsController@reply',
        'as' => 'discussion.reply'
    ]);

    Route::get('/reply/like/{id}', [
        'uses' => 'RepliesController@like',
        'as' => 'reply.like'
    ]);

    Route::get('/reply/unlike/{id}', [
        'uses' => 'RepliesController@unlike',
        'as' => 'reply.unlike'
    ]);

    Route::get('/discussion/watch/{id}', [
        'uses' => 'WatcherController@watch',
        'as' => 'discussion.watch'
    ]);

    Route::get('/discussion/unwatch/{id}', [
        'uses' => 'WatcherController@unwatch',
        'as' => 'discussion.unwatch'
    ]);

    Route::get('/reply/best/{id}', [
        'uses' => 'RepliesController@bestAnswer',
        'as' => 'reply.best'
    ]);

    Route::get('/reply/edit/{id}', [
        'uses' => 'RepliesController@edit',
        'as' => 'reply.edit'
    ]);

    Route::post('/reply/update/{id}', [
        'uses' => 'RepliesController@update',
        'as' => 'reply.update'
    ]);

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forum', [
    'uses' => 'ForumsController@index',
    'as' => 'forum'
]);

Route::get('/discussion/{slug}/{id}', [
    'uses' => 'DiscussionsController@show',
    'as' => 'discussion'
]);

Route::get('/channel/{slug}', [
    'uses' => 'ForumsController@channel',
    'as' => 'channel'
]);

