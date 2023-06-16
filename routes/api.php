<?php

use App\Http\Controllers\ConversationController;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Conversations;
use App\Http\Controllers\MessageController;

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
require ('api_authentfication.php');
require('api_articles.php');
require('api_preference.php');
require('api_tags.php');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   // return $request->user();
    //Route::get('/messages/{recipient_id}', 'App\Http\Controllers\MessageController@index');
   // Route::post('/messages', 'App\Http\Controllers\MessageController@store');
   // Route::delete('/messages/{id}', 'App\Http\Controllers\MessageController@destroy');
  
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('message', MessageController::class);
    Route::resource('conversation',ConversationController::class);

    Route::get('/messages/{id}',[MessageController::class,'listemessage']);
});


