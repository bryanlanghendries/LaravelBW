<?php

use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('index');

Route::resource('posts', PostController::class);

Route::get('like/{postid}', [LikeController::class,'like'])->name('like');

Route::get('user/{name}', [UserController::class, 'profile'])->name('profile');

Route::get('user/{name}/edit', [UserController::class, 'edit'])->name('profile.edit');

Route::patch('user/{name}', [UserController::class,'update'])->name('profile.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
