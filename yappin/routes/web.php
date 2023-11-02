<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FAQItemController;
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

// Public routes
Route::get('/', [PostController::class, 'index'])->name('index');
Route::resource('posts', PostController::class);

// User profile rotues
Route::get('user/{name}', [UserController::class, 'profile'])->name('profile');
Route::get('user/{name}/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::patch('user/{name}', [UserController::class,'update'])->name('profile.update');

// About and contact routes
Route::get('about', function () { return view('about.about'); })->name('about');
Route::get('contact', [ContactFormController::class, 'index'])->name('contact');

// FAQ routes
Route::get('faq', [FAQItemController::class, 'index'])->name('faq');
Route::post('faq', [FAQItemController::class,'store'])->name('faq.store');

// Comments and likes on posts
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comment');
Route::get('like/{post}', [LikeController::class,'like'])->name('like');

// Auth routes
Auth::routes();