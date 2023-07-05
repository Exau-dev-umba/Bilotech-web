<?php

use App\Http\Controllers\ArticleController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;


Route::get('/tags', [TagController::class, 'index'])->name('tag.index');

    
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/tags', [TagController::class, 'index'])->name('tag.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tag.create'); 
    Route::post('/tags', [TagController::class, 'store'])->name('tag.store');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tag.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tag.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    
    Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
});
    



    