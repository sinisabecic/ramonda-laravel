<?php
//? Posts
use App\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//? Photos (public)
Route::get('/photos', 'PhotosController@index');
Route::put('/photos/profile/{user}/update', 'UsersController@updateProfilePhoto')->name('profile.photo.update');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('/media/photos', 'PhotosController')
        ->name('index', 'media.photos')
        ->name('destroy', 'media.photos.destroy');
    Route::put('/photos/{id}/restore', 'PhotosController@restore');
    Route::delete('/photos/{id}/remove', 'PhotosController@remove');

// ! Ako je u controller funkciji function(User user) i u rutu mora pisati: {user}
    Route::put('/photos/user/{user}/update', 'UsersController@updatePhoto')->name('user.photo.update');
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


