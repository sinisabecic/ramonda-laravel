<?php
//? Posts
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//? Svako ko je prijavljen moze da vidi svoj profil
Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth'],
], function () {
    Route::get('/', 'HomeController')->name('admin');
    Route::get('/users/{user}/profile', 'UsersController@profile')->name('user.profile.show');
});

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth', 'can:updateProfile,user'],
], function () {
    Route::put('/users/{user}/profile', 'UsersController@profileUpdate')->name('user.profile.update');
});

//? Users
Route::group([
//    'prefix' => 'admin',
//    'as' => 'admin.',
    'namespace' => 'Admin', // da ne pisemo Admin\HomeController u action:
    'middleware' => ['role:admin', 'auth'],
], function () {
    Route::resource('/users', 'UsersController')
        ->name('index', 'users')
        ->name('store', 'users.store')
        ->name('update', 'users.update')
        ->name('destroy', 'user.delete');

    Route::delete('/users/{id}/remove', 'UsersController@remove')->name('users.remove');
    Route::put('/users/{id}/restore', 'UsersController@restore');

    //? Roles
    Route::resource('/roles', 'RolesController')
        ->name('index', 'roles')
        ->name('store', 'roles.store')
        ->name('update', 'roles.update')
        ->name('destroy', 'roles.delete');
    Route::delete('/roles/{id}/remove', 'RolesController@remove');
    Route::put('/roles/{id}/restore', 'RolesController@restore');

    //? Permissions
    Route::resource('/permissions', 'PermissionsController')
        ->name('index', 'permissions')
        ->name('store', 'permissions.store')
        ->name('edit', 'permissions.edit')
        ->name('update', 'permissions.update')
        ->name('destroy', 'permissions.delete');
    Route::delete('/{id}/remove', 'PermissionsController@remove');
    Route::put('/permissions/{id}/restore', 'PermissionsController@restore');
});
