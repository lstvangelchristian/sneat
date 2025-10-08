<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pages\BlogController;
use App\Http\Controllers\Pages\CommentController;
use App\Http\Controllers\Pages\ReactionController;
use App\Http\Controllers\Pages\ReplyController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show-register');
    Route::post('/register', 'register')->name('register');
});

Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('show-login');
    Route::post('/login', 'login')->name('login');
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->controller(BlogController::class)->group(function () {
    Route::get('/blog', 'showBlog')->name('show-blog');
    Route::post('/blog', 'createBlog')->name('create-blog');
    Route::get('/blog/update/{id}', 'renderUpdateModal')->name('render-update-modal');
    Route::put('/blog/update/{id}', 'updateBlog')->name('update-blog');
    Route::delete('/blog/delete/{id}', 'deleteBlog')->name('delete-blog');
});

Route::middleware('auth')->controller(ReactionController::class)->group(function () {
    Route::post('/reaction', 'createReaction')->name('create-reaction');
    Route::get('/reaction/{id}', 'getReactionsByBlogId')->name('get-reactions');
});

Route::middleware('auth')->controller(CommentController::class)->group(function () {
    Route::get('/comment/create/modal/{id}', 'renderCreateCommentModal')->name('render-create-comment-modal');
    Route::post('/comment', 'createComment')->name('create-comment');
    Route::get('/comment/{id}', 'renderComments')->name('render-comments');
    Route::get('/comment/edit/{id}', 'getComment')->name('get-comment');
    Route::get('/comment/load/{id}', 'loadComments');
    Route::put('/comment', 'updateComment');
    Route::delete('/comment/{id}', 'deleteComment');
});

Route::middleware('auth')->controller(ReplyController::class)->group(function () {
    Route::get('/replies/{id}', 'getReplies');
    Route::post('/replies', 'createReply');
    Route::get('/reply/{id}', 'getReply');
    Route::put('/reply', 'updateReply');
    Route::delete('/reply/{id}', 'deleteReply');
});
