<?php

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


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


Route::post('/login', function (Request $request) {

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {

        return response()->json(['message' => 'Email ou mot de passe incorrect']);
    }
    $token = $user->createToken($request->email)->plainTextToken;
    $user = new UserResource($user);

    return response()->json(['user' => $user, 'token' => $token]);
});

Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    /*Route of user*/
    Route::get('/user', [AuthController::class, 'user']);
    // Route of user logout
    Route::post('/logout', [AuthController::class, 'logout']);

});