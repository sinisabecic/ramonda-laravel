<?php
//? Posts
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//? Posts (public)
Route::get('/posts', 'PostsController@index');
Route::get('/posts/create', 'PostsController@create');
Route::get('/posts/{id}', 'PostsController@show');

//? Comments
Route::post('/posts/{post}/comment', 'CommentsController@store')->name('post.comment.store');

Route::middleware(['auth'])->group(function () {

    Route::resource('/posts', 'PostsController')
        ->name('index', 'blog.posts')
        ->name('create', 'blog.posts.create')
        ->name('store', 'blog.posts.store')
        ->name('edit', 'blog.posts.edit')
        ->name('update', 'blog.posts.update')
        ->name('destroy', 'blog.posts.destroy');
    Route::put('/posts/{id}/restore', 'PostsController@restore');
    Route::delete('/posts/{id}/remove', 'PostsController@remove');


});

