<?php

use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/post/{$id}/photos', function ($id) {
    $photos = Photo::all();
    $users = User::withTrashed()->get();
    $posts = Post::find($id);

//    foreach ($photos as $photo) {
//        return $photo->imageable;
//    }
    foreach ($posts as $post) {
        return $post->photo;
    }
});

Route::get('/users/photos', function () {

    $users = User::withTrashed()->get();

    foreach ($users as $user) {
        foreach ($user->photos as $img) {
            echo $img->url;
        }
    }
});

Route::get('/user/{id}/photo', function ($id) {

    $user = User::find(1);
    echo $user->photo->url;
//    foreach ($users as $user) {
//        return $user->photos()->imageable;
//    }
});


