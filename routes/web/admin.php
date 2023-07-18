<?php
use App\Http\Controllers\Admin\UsersController;

Route::get('/', function() {
    return view('admin.index');
});

Route::resource('users', UsersController::class);