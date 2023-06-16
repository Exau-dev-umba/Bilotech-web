<?php

use Illuminate\Support\Facades\Route;
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





Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('users/preferences', [PreferenceController::class, 'ajoutPreferences']);

    Route::get('users/preferences', [PreferenceController::class, 'recuperePreferences']);
    Route::put('users/preferences', [PreferenceController::class, 'modifiePreferences']);

});