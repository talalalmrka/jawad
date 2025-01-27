<?php

use App\Http\Controllers\Dashboard\Posts\PostController;
use App\Http\Controllers\Dashboard\Users\UserController;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//users
Route::get('dashboard/users', [UserController::class, 'index'])
    ->name('dashboard.users')
    ->middleware('auth');

Route::get('dashboard/users/edit/{user}', [UserController::class, 'edit'])
    ->name('dashboard.users.edit')
    ->middleware('auth');

Route::post('dashboard/users/update/{user}', [UserController::class, 'update'])
    ->name('dashboard.users.update')
    ->middleware('auth');

Route::get('dashboard/users/create', [UserController::class, 'create'])
    ->name('dashboard.users.create')
    ->middleware('auth');

Route::post('dashboard/users/store', [UserController::class, 'store'])
    ->name('dashboard.users.store')
    ->middleware('auth');

Route::get('dashboard/users/delete/{user}', [UserController::class, 'delete'])
    ->name('dashboard.users.delete')
    ->middleware('auth');

//posts
Route::get('dashboard/posts', [PostController::class, 'index'])
    ->name('dashboard.posts')
    ->middleware('auth');

Route::get('dashboard/posts/edit/{post}', [PostController::class, 'edit'])
    ->name('dashboard.posts.edit')
    ->middleware('auth');

Route::post('dashboard/posts/update/{post}', [PostController::class, 'update'])
    ->name('dashboard.posts.update')
    ->middleware('auth');

Route::get('dashboard/posts/create', [PostController::class, 'create'])
    ->name('dashboard.posts.create')
    ->middleware('auth');

Route::post('dashboard/posts/store', [PostController::class, 'store'])
    ->name('dashboard.posts.store')
    ->middleware('auth');

Route::get('dashboard/posts/delete/{post}', [UserController::class, 'delete'])
    ->name('dashboard.posts.delete')
    ->middleware('auth');