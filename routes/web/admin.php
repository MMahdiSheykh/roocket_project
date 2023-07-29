<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\UserPermissionController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('admin.index');
});

Route::resource('users', UsersController::class);
Route::get('users/{user}/permission', [UserPermissionController::class, 'create'])->name('users.permissions');
Route::post('users/{user}/permission', [UserPermissionController::class, 'store'])->name('users.permissions.store');
Route::resource('permission', PermissionController::class);
Route::resource('rule', RuleController::class);
Route::resource('product', ProductController::class)->except(['show']);
Route::resource('comments', CommentController::class)->only(['index', 'update', 'destroy']);
Route::resource('categories', CategoryController::class)->except(['show']);
