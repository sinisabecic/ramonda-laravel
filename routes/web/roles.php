<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//? Users
Route::group([
    'namespace' => 'Admin',
    'middleware' => ['role:admin', 'auth'],
], function () {

    //? Roles
    Route::resource('/roles', 'RolesController')
        ->name('index', 'roles')
        ->name('store', 'roles.store')
        ->name('update', 'roles.update')
        ->name('destroy', 'roles.delete');
    Route::delete('/roles/{id}/remove', 'RolesController@remove');
    Route::put('/roles/{id}/restore', 'RolesController@restore');

});
