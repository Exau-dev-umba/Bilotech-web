<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ArticleController;


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

Route::get('articles', 'ArticleController@search');
Route::post('articles/{id}/images', [ImageController::class, 'store']);
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('articles', ArticleController::class, ["as" => "api"]);
});

