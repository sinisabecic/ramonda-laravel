<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//? Users
Route::group([
    'namespace' => 'Admin',
    'middleware' => ['role:admin', 'auth'],
], function () {

//? Permissions
    Route::resource('/permissions', 'PermissionsController')
        ->name('index', 'permissions')
        ->name('store', 'permissions.store')
        ->name('edit', 'permissions.edit')
        ->name('update', 'permissions.update')
        ->name('destroy', 'permissions.delete');
    Route::delete('/permissions/{id}/remove', 'PermissionsController@remove');
    Route::put('/permissions/{id}/restore', 'PermissionsController@restore');
});
