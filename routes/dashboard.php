<?php

use App\Http\Controllers\Dashboard\Permissions\PermissionController;
use App\Http\Controllers\Dashboard\Posts\PostController;
use App\Http\Controllers\Dashboard\Users\UserController;

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'dashboard'], function () {
    Route::view('/', 'dashboard')
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

    //users
    Route::get('/users', [UserController::class, 'index'])
        ->name('dashboard.users');

    Route::get('/users/edit/{user}', [UserController::class, 'edit'])
        ->name('dashboard.users.edit');
    Route::post('/users/update/{user}', [UserController::class, 'update'])
        ->name('dashboard.users.update');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('dashboard.users.create');
    Route::post('/users/store', [UserController::class, 'store'])
        ->name('dashboard.users.store');
    Route::get('/users/delete/{user}', [UserController::class, 'delete'])
        ->name('dashboard.users.delete');
    Route::post('/users/action', [UserController::class, 'action'])
        ->name('dashboard.users.action');

    //posts
    Route::get('/posts', [PostController::class, 'index'])
        ->name('dashboard.posts')
        ->middleware('auth');

    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])
        ->name('dashboard.posts.edit');

    Route::post('/posts/update/{post}', [PostController::class, 'update'])
        ->name('dashboard.posts.update');
    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('dashboard.posts.create');

    Route::post('/posts/store', [PostController::class, 'store'])
        ->name('dashboard.posts.store');

    Route::get('/posts/delete/{post}', [PostController::class, 'delete'])
        ->name('dashboard.posts.delete');

    Route::post('/posts/action', [PostController::class, 'action'])
        ->name('dashboard.posts.action');

    //permissions
    Route::get('/permissions', [PermissionController::class, 'index'])
        ->name('dashboard.permissions')
        ->middleware('auth');

    Route::get('/permissions/edit/{permission}', [PermissionController::class, 'edit'])
        ->name('dashboard.permissions.edit');

    Route::post('/permissions/update/{post}', [PermissionController::class, 'update'])
        ->name('dashboard.permissions.update');
    Route::get('/permissions/create', [PermissionController::class, 'create'])
        ->name('dashboard.permissions.create');

    Route::post('/permissions/store', [PermissionController::class, 'store'])
        ->name('dashboard.permissions.store');

    Route::get('/permissions/delete/{post}', [PermissionController::class, 'delete'])
        ->name('dashboard.permissions.delete');

    Route::post('/permissions/action', [PermissionController::class, 'action'])
        ->name('dashboard.permissions.action');

});
