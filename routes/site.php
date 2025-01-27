<?php

use App\Http\Controllers\Site\Home\HomeController;
use App\Http\Controllers\Site\Posts\PostController;
Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/blog', [PostController::class, 'index'])->name('site.posts');
Route::get('/blog/{post:slug}', [PostController::class, 'single'])->name('site.post');
