<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login']);

Route::get('/register',[LoginController::class,'create'])->name('register');
Route::post('/register',[LoginController::class,'store']);

Route::post('/logout',[LogoutController::class,'index'])->name('logout');

Route::get('/users/edit',[UserController::class,'edit'])->name('users.edit');
Route::get('/users/{username}',[UserController::class,'show'])->name('users');
Route::patch('/users/edit',[UserController::class,'update'])->name('users.update');

Route::post('/follow/{id}',[ProfileController::class,'store'])->name('follow');
Route::post('/unfollow/{id}',[ProfileController::class,'destroy'])->name('unfollow');

Route::get('/post/create',[PostController::class,'create'])->name('post');
Route::get('/post/{post}',[PostController::class,'show'])->name('post.show');
Route::post('/post',[PostController::class,'store'])->name('post.store');

Route::post('/comment/{id}/create',[CommentController::class,'store'])->name('comment');

Route::get('/', [PostController::class,'index']);
