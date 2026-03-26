<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticlePremiumController;
use App\Http\Controllers\ArticleUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::redirect('/', '/articles');
    
    Route::get('/my-articles', [ArticleUserController::class, 'index'])->name('articles.my-articles');
    Route::get('/premium-articles', [ArticlePremiumController::class, 'index'])->name('articles.premium-articles');
    
    Route::delete('/articles/{article}/destroy-image', [ImageController::class, 'destroy'])->name('articles.destroy-image');

    Route::get('/my-categories', [CategoryController::class, 'index'])->name('categories.my-categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/upgrade-premium', [UserController::class, 'upgradeToPremium'])->name('users.upgrade-premium');
    
    Route::delete('/logout', [SessionsController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    
    Route::get('/login', [SessionsController::class, 'create'])->name('login.create');
    Route::post('/login', [SessionsController::class, 'store'])->name('login.store');
});
