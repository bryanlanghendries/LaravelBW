<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FAQCategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FAQItemController;
use App\Http\Controllers\MessageController;
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

// User profile routes
Route::get('user/{name}', [UserController::class, 'profile'])->name('profile');
Route::get('user/{name}/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::patch('user/{name}', [UserController::class, 'update'])->name('profile.update');
Route::post('user/{name}/promote', [UserController::class, 'promote'])->name('profile.promote');

// About and contact routes
Route::get('about', function () {
    return view('about.about');
})->name('about');

Route::get('contact', [MessageController::class, 'index'])->name('contact');
Route::post('contact/store', [MessageController::class, 'store'])->name('contact.store');

// FAQ routes
Route::get('faq', [FAQItemController::class, 'index'])->name('faq');
Route::post('faq', [FAQItemController::class, 'store'])->name('faq.store');
Route::delete('item/{faqitem}', [FAQItemController::class, 'destroy'])->name('faqitem.destroy');
Route::get('item/{faqitem}/edit', [FAQItemController::class, 'edit'])->name('faqitem.edit');
Route::put('item/{faqitem}', [FAQItemController::class, 'update'])->name('faqitem.update');
Route::get('faq/category/{category}', [FAQItemController::class, 'category'])->name('faq.category');

// FAQCategory routes
Route::post('category/store', [FAQCategoryController::class, 'store'])->name('category.store');
Route::delete('category/{category}', [FAQCategoryController::class, 'destroy'])->name('category.destroy');

// Comments and likes on posts
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comment');
Route::get('like/{post}', [LikeController::class, 'like'])->name('like');

// Admin routes
Route::get('admin', [AdminController::class, 'index'])->name('admin.index');

// Auth routes
Auth::routes();