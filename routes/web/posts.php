<?php
//? Posts
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth'],
], function () {
    Route::resource('/posts', 'PostsController')
        ->name('index', 'posts.index')
        ->name('store', 'posts.store')
        ->name('edit', 'posts.edit')
        ->name('update', 'posts.update')
        ->name('destroy', 'posts.destroy');
    Route::put('/posts/{id}/restore', 'PostsController@restore');
    Route::delete('/posts/{id}/remove', 'PostsController@remove');

    //? Tags
    Route::resource('/tags', 'TagsController')
        ->name('index', 'tags')
        ->name('store', 'tags.store')
        ->name('edit', 'tags.edit')
        ->name('update', 'tags.update')
        ->name('destroy', 'tags.delete');
    Route::put('/tags/{id}/restore', 'TagsController@restore');
    Route::delete('/tags/{id}/remove', 'TagsController@remove');
});

