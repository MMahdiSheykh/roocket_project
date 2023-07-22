<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PermissionController;

Route::get('/', function() {
    return view('admin.index');
});

Route::resource('users', UsersController::class);
Route::resource('permission', PermissionController::class);