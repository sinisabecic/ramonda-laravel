<?php
//? Posts
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/posts', 'PostsController@show');
Route::get('/posts/{id}', 'PostsController@show');

Route::middleware(['auth'])->group(function () {

    Route::resource('/posts', 'PostsController')
        ->name('index', 'posts.index')
        ->name('store', 'posts.store')
        ->name('edit', 'posts.edit')
        ->name('update', 'posts.update')
        ->name('destroy', 'posts.destroy');
    Route::put('/posts/{id}/restore', 'PostsController@restore');
    Route::delete('/posts/{id}/remove', 'PostsController@remove');


});

