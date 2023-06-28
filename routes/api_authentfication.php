<?php

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Visites_articles;
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
    $validate = $request->validate([
        'email' => "required",
        'password' => "required"
    ]);

    if (!Auth::attempt($validate)) {
        return response()->json([
            'message' => "Mot de passe ou email incorrect"
        ], 422);
    }
    //$token = $user->createToken($request->email)->plainTextToken;
    $user = new UserResource(auth()->user());
    
    $ip = $request->ip();
    Visites_articles::where('ip_address', $ip)
        ->update(['user_id' => $user->id]);

    return response()->json([
        'status' => true,
        'user' => $user ,
        'token' => auth()->user()->createToken('secret')->plainTextToken
    ], 200);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/user/{id}/image', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/allUser',[AuthController::class,'allUser']);
    /*Route of user*/

    Route::get('/userUpdate', [AuthController::class, 'updateUser']);

    Route::get('/singleUser', [AuthController::class, 'singleUser']);

    // Route of user logout
    Route::post('/logout', [AuthController::class, 'logout']);

});