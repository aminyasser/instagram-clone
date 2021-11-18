<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home')->middleware('auth');
Route::get('/newPost', [App\Http\Controllers\PostController::class, 'create'])->name('post.new')->middleware('auth');
Route::get('/post/show/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show')->middleware('auth');
Route::get('/post/delete/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete')->middleware('auth');
Route::get('/hashtag/{hash}', [App\Http\Controllers\TagController::class, 'index'])->name('post.hashtag')->middleware('auth');

Route::get('/{username}', [App\Http\Controllers\UserController::class, 'index'])->name('user.profile')->middleware('auth');
Route::get('/accounts/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit')->middleware('auth');


