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

Route::group(['prefix' => 'blog', 'namespace' => 'Blog'], function () {

    Route::get('/', 'HomeController@index')->name('blog.home');
    Route::get('/post/{slug}', 'HomeController@show')->name('blog.post');
});


Route::get('/getusers', function () {
//    return \Illuminate\Support\Facades\DB::table('users')->get();
    return User::with('photos')->withTrashed()->get();
});


