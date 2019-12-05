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
use App\Post;
use App\User;
use App\Comment;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', function() {
	$posts = Post::where('author_id', '=', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(3);
	return view('home')->with('posts', $posts);
})->middleware('auth');

Route::get('addPostForm', 'PostsController@addPostForm');

Route::post('addPost', 'PostsController@addPost');

Route::get('allPosts', 'PostsController@allPosts');

Route::get('{postId}/editForm', 'PostsController@editForm');

Route::post('{postId}/edit', 'PostsController@editPost');

Route::get('{postId}/delete', 'PostsController@deletePost');

Route::get('{postId}/guest', 'PostsController@guestViewPost');

Route::get('Like/{postId}', 'PostsController@like');

Route::get('Liked/{postId}', 'PostsController@liked');

Route::get('{comments}/{postId}', 'PostsController@comment');

