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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource("discussion","DiscussionController");

Route::post("/reply/{id}","ReplyController@store")->name('reply.store');
Route::get("/reply/{id}/edit","ReplyController@edit")->name('reply.edit');
Route::put("/reply/{id}","ReplyController@update")->name('reply.update');
Route::delete("/reply/{id}","ReplyController@destroy")->name('reply.destroy');
#Route::resource("reply","ReplyController");


Route::get('channels/{channel}', 'ChannelController@show')->name('channels.show');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource("channels","ChannelController",['except' => 'show']);
    Route::resource("user", "UserController");
    Route::resource("roles", "RoleController");
});

Route::group(['prefix' => 'panel'], function (){
    Route::resource("profile", "ProfileController", ['except' => 'index']);
    Route::get("/changepassword", "ProfileController@changePassword")->name('profile.changePassword')->middleware('auth');
    Route::post("/resetPassword", "ProfileController@resetPassword")->name('profile.resetPassword')->middleware('auth');
    #Route::get('profile/{user}', 'ProfileController@index')->name('profile.index');
});

Route::post('/like/{id}', 'LikeController@likeReply')->name('like');
Route::delete('/dislike/{id}', 'LikeController@dislikeReply')->name('dislike');


Route::get('/bestreply/{did}/{rid}', 'DiscussionController@best_reply')->name('best_reply');
Route::delete('/bestreply/{did}', 'DiscussionController@remove_best_reply')->name('remove_best_reply');
Route::get('/close/{did}', 'DiscussionController@close')->name('discussion.close');
Route::get('/open/{did}', 'DiscussionController@open')->name('discussion.open');
