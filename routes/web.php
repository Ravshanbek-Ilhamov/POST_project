<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeOrDislikeController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Models\LikeOrDislike;
use Illuminate\Support\Facades\Route;

// auth
Route::get('/',[AuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AuthController::class,'login'])->name('login');


Route::get('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/registration',[AuthController::class,'registerPage'])->name('registerPage');
Route::post('/register',[AuthController::class,'register'])->name('register');


#user
Route::get('/users',[UserController::class,'index'])->name('user.index');
Route::get('/user-page',[AuthController::class,'userPage'])->name('user.page');


// Category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category_creation', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category-update/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category-delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');


# Likes
Route::get('/likes', [LikeOrDislikeController::class, 'index'])->name('like.index');
Route::get('/like-create', [LikeOrDislikeController::class, 'create'])->name('like.create');
// Route::post('/like-creation', [LikeOrDislikeController::class, 'store'])->name('like.store');
Route::put('/like-update{likeOrDislike}', [LikeOrDislikeController::class, 'update'])->name('like.update');
Route::delete('/like-delete/{likeOrDislike}', [LikeOrDislikeController::class, 'destroy'])->name('like.destroy');
Route::post('/like-store', [LikeOrDislikeController::class, 'storeLikes'])->name('like.store');
// Route::post('/reaction', [LikeOrDislikeController::class, 'toggleReaction'])->name('reaction.toggle');
Route::get('/reaction/{post},{id}', [LikeOrDislikeController::class, 'toggleReaction'])->name('reaction.toggle');


# Posts
Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/post-create', [PostController::class, 'create'])->name('post.create');
Route::post('/post_creation', [PostController::class, 'store'])->name('post.store');
Route::get('/post-edit/{post}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post_update/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post-delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');
Route::get('/post-details/{post}',[PostController::class,'detailing'])->name('post.detail');
Route::get('/posts/category/{category}', [PostController::class, 'category'])->name('posts.category');


# Comments
Route::get('/comments', [CommentController::class, 'index'])->name('comment.index');
Route::get('/comment-create', [CommentController::class, 'create_page'])->name('comment.create');
Route::post('/comment_creation', [CommentController::class, 'store'])->name('comment.store');
Route::put('/comment-update/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comment-delete/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');


Route::get('/views', [ViewController::class, 'index'])->name('view.index');
Route::get('/view-create', [ViewController::class, 'create'])->name('view.create');
Route::post('/view_creation', [ViewController::class, 'store'])->name('view.store');
Route::put('/view-update/{view}', [ViewController::class, 'update'])->name('view.update');
Route::delete('/view-delete/{view}', [ViewController::class, 'destroy'])->name('view.destroy');


#Reactions
Route::post('/LikeReaction', [LikeOrDislikeController::class, 'likes'])->name('like');
Route::post('/DislikeReaction', [LikeOrDislikeController::class, 'dislikes'])->name('dislike');



# Requests
Route::get('/requests', [RequestController::class, 'index'])->name('request.index');
Route::post('/request-create', [RequestController::class, 'store'])->name('request.store');
Route::delete('/request-delete/{request}', [RequestController::class, 'destroy'])->name('request.destroy');
Route::put('/request-edit/{id}', [RequestController::class, 'update'])->name('requests.update');


# Options
Route::get('/options', [OptionsController::class, 'index'])->name('option.index');
Route::post('/option-creation', [OptionsController::class, 'store'])->name('option.store');
Route::put('/option-update/{option}', [OptionsController::class, 'update'])->name('option.update');
Route::delete('/option-delete/{option}', [OptionsController::class, 'destroy'])->name('option.destroy');


# Answers
Route::get('/answers', [AnswerController::class, 'index'])->name('answer.index');
Route::post('/answer-creation', [AnswerController::class, 'store'])->name('answer.store');
Route::put('/answer-update/{answer}', [AnswerController::class, 'update'])->name('answer.update');
Route::delete('/answer-delete/{answer}', [AnswerController::class, 'destroy'])->name('answer.destroy');
