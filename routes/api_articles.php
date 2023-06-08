<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Api\CategoryController;


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



Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/search', [ArticleController::class, 'search']);
Route::post('articles/{id}/images', [ImageController::class, 'store']);
Route::get('categories', [CategoryController::class, 'index']);
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('articles', ArticleController::class, ["as" => "api"])->except(['index']);
});

