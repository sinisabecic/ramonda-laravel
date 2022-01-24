<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::resource('/tags', 'TagsController')
    ->name('index', 'tags')
    ->name('store', 'tags.store')
    ->name('edit', 'tags.edit')
    ->name('update', 'tags.update')
    ->name('destroy', 'tags.delete');
Route::put('/tags/{id}/restore', 'TagsController@restore');
Route::delete('/tags/{id}/remove', 'TagsController@remove');

