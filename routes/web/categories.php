<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::resource('/categories', 'CategoriesController')
    ->name('index', 'blog.categories')
    ->name('store', 'blog.categories.store')
    ->name('update', 'blog.categories.update')
    ->name('destroy', 'blog.categories.delete');

Route::delete('/categories/{id}/remove', 'CategoriesController@remove');
Route::put('/categories/{id}/restore', 'CategoriesController@restore');

