<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeOrDislikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// auth
Route::get('/',[AuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/registration',[AuthController::class,'registerPage'])->name('registerPage');
Route::post('/register',[AuthController::class,'register'])->name('register');


#user
Route::get('/users',[UserController::class,'index'])->name('user.index');

// Category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category_creation', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category-update/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category-delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

# Likes
Route::get('/likes', [LikeOrDislikeController::class, 'index'])->name('like.index');
Route::get('/like-create', [LikeOrDislikeController::class, 'create_page'])->name('like.create');
Route::post('/like_creation', [LikeOrDislikeController::class, 'store'])->name('like.store');
Route::delete('/like-delete/{like}', [LikeOrDislikeController::class, 'destroy'])->name('like.destroy');

# Posts
Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/post-create', [PostController::class, 'create'])->name('post.create');
Route::post('/post_creation', [PostController::class, 'store'])->name('post.store');
Route::get('/post-edit/{post}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post_update/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post-delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');

# Comments
Route::get('/comments', [CommentController::class, 'index'])->name('comment.index');
Route::get('/comment-create', [CommentController::class, 'create_page'])->name('comment.create');
Route::post('/comment_creation', [CommentController::class, 'store'])->name('comment.store');
Route::put('/comment-update/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comment-delete/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
