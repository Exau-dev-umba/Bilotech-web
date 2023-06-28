<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConversationController;


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


Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('message', MessageController::class);
    Route::resource('conversation',ConversationController::class);
    Route::get('/message/{id}',[MessageController::class,'listemessage']);
    Route::get ('/message/conversation/{conversation_id}',[MessageController::class,'messageParConversation']);
    Route::get ('/client/conversation',[ConversationController::class,'conversationClient']);
    Route::get ('/vendeur/conversation',[ConversationController::class,'conversationVendeur']);

    
});