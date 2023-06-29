<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('articles/search', [ArticleController::class, 'search']);
Route::get('/categories/{category}/articles', [CategoryController::class, 'getArticlesByCategory']);
Route::get('category', [CategoryController::class, 'index']);
Route::get('categories', 'App\Http\Controllers\Api\CategoryController@index');
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{article}/similar', [ArticleController::class, 'similar']);
Route::get('articles/{article}', [ArticleController::class, 'show']);
Route::get('articles/search', [ArticleController::class, 'search']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/articles/{id}/likes', [LikeController::class, 'likeOrUnlike']);
    Route::get('/sold/aticles', [ArticleController::class, 'sold']);
    Route::get('/my_purchases/articles', [ArticleController::class, 'my_purchases']);
    Route::post('articles/{id}/images', [ImageController::class, 'store']);
    Route::apiResource('articles', ArticleController::class, ['as' => 'api'])->except(['index', 'show', 'my_purchases']);
});
