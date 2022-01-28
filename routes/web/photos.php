<?php
//? Posts
use App\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//? Posts (public)
Route::get('/photos', 'PhotosController@index');


Route::middleware(['auth'])->group(function () {

    Route::resource('/media/photos', 'PhotosController')
        ->name('index', 'media.photos')
        ->name('destroy', 'media.photos.destroy');
    Route::put('/photos/{id}/restore', 'PhotosController@restore');
    Route::delete('/photos/{id}/remove', 'PhotosController@remove');

});

