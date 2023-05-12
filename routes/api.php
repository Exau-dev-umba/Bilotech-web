<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\conversationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    //Route::get('/messages/{recipient_id}', 'App\Http\Controllers\MessageController@index');
   // Route::post('/messages', 'App\Http\Controllers\MessageController@store');
   // Route::delete('/messages/{id}', 'App\Http\Controllers\MessageController@destroy');
});

Route::resource('message', MessageController::class);
