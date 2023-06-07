<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\PreferenceController;


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

Route::get('/tag', [TagController::class, 'index']);
Route::post('/tag', [TagController::class, 'store']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('users/preferences', [PreferenceController::class, 'recuperePreferences']);
    Route::put('users/preferences', [PreferenceController::class, 'modifiePreferences']);

});